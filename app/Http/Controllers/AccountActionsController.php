<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\{Korisnik, Rezervacija};
use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountActionsController extends Controller
{
    //Pronalazenje trenutnog korisnika
    public $korisnik;
    function __construct()
    {
        $this->korisnik = Korisnik::where('Korisnicko_Ime', Cookie::get('korisnik'))->first();
    }

    //Metoda za prikazivanje stranice naloga sa informacijama o korisniku
    public function stranicaNaloga()
    {
        $brRezervacija = Rezervacija::where('ID_Korisnika', $this->korisnik['ID_Korisnika'])->count();

        return view('account.dashboard', ['korisnik' => $this->korisnik, 'brRezervacija' => $brRezervacija]);
    }

    //Metoda za prikazivanje rezervacija korisnika
    public function pregledajRezervacije()
    {
        //Dohvatanje svih 'user-friendly' informacija o rezervacijama korisnika
        $rezervacije = Rezervacija::where('rezervacija.ID_Korisnika', $this->korisnik['ID_Korisnika'])->join('let', 'rezervacija.Br_Leta', '=', 'let.Br_Leta')
            ->join('avio_kompanija', 'rezervacija.ICAO_Kod', '=', 'avio_kompanija.ICAO_Kod')->join('aerodrom as polazni', 'let.Polazni_Aerodrom', '=', 'polazni.ICAO_Kod_Aerodroma')
            ->join('aerodrom as dolazni', 'let.Dolazni_Aerodrom', '=', 'dolazni.ICAO_Kod_Aerodroma')->join('nalog', function (JoinClause $join)
            {
                $join->on('rezervacija.ID_Korisnika', '=', 'nalog.ID_Korisnika')->on('rezervacija.Br_Leta', '=', 'nalog.Br_Leta')->on('rezervacija.Datum_Polaska', '=', 'nalog.Datum_Polaska');
            })->select('rezervacija.*', 'let.Vreme_Polaska', 'polazni.Ime as PolazniAerodrom', 'dolazni.Ime as DolazniAerodrom', 'avio_kompanija.Ime as avioKompanija', 'nalog.Iznos')
            ->orderBy('rezervacija.Datum_Polaska', 'asc')->get();

        //Racunanje broja dana do polaska za svaku rezervaciju
        foreach ($rezervacije as $rezervacija)
        {
            $danaDo = Carbon::now()->diffInDays($rezervacija['Datum_Polaska']);
            $rezervacija['danaDo'] = $danaDo;
        }

        return view('account.reservations', ['rezervacije' => $rezervacije]);
    }

    public function stranicaIzmeni()
    {
        return view('account.edit', ['korisnik' => $this->korisnik]);
    }

    //Metoda za brisanje naloga, postavljanjem vrednosti polja isDeleted na 1
    public function obrisiNalog()
    {
        $this->korisnik['Is_Deleted'] = 1;
        $this->korisnik->save();

        return redirect('/logout');
    }

    //Metoda za izmenu osnovnih podataka o nalogu korisnika
    public function izmeniOsnovnePodatke(Request $request)
    {
        //validacija polja
        $validacija = Validator::make($request->all(), [
            'username' => 'required|alpha_dash',
            'email' => 'required|email'
        ], $messages = [
            'required' => 'Sva polja su obavezna!',
            'alpha_dash' => 'Korisnicko ime ne sme da ima razmak!',
            'email' => 'Email nije validan!'
        ]);

        if ($validacija->fails())
        {
            return redirect('/account/edit')->withErrors($validacija);
        }

        //Ukoliko je korisnik uneo novo korisnicko ime, proverava da li je slobodno i menja ga ako jeste
        if ($this->korisnik['Korisnicko_Ime'] != $request->input('username'))
        {
            $korisnik = Korisnik::where('Korisnicko_Ime', $request->input('username'))->first();
            if ($korisnik)
            {
                return redirect('/account/edit')->withErrors('Novo korisnicko ime je zauzeto!');
            }
            else
            {
                $this->korisnik['Korisnicko_Ime'] = $request->input('username');
                Cookie::queue('korisnik', $request->input('username'), 60 * 24 * 30);
            }
        }

        //Isto se ponavlja za email
        if ($this->korisnik['Email'] != $request->input('email'))
        {
            $korisnik = Korisnik::where('Email', $request->input('email'))->first();
            if ($korisnik)
            {
                return redirect('/account/edit')->withErrors('Novi email je zauzet!');
            }
            else
            {
                $this->korisnik['Email'] = $request->input('email');
            }
        }

        $this->korisnik->save();
        return redirect('/account/dashboard');
    }

    //Metoda za izmenu Licnih podataka o nalogu korisnika
    function izmeniLicnePodatke(Request $request)
    {
        //validacija polja
        $validacija = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'address' => 'required'
        ], $messages = [
            'required' => 'Sva polja su obavezna!',
        ]);
        if ($validacija->fails())
        {
            return redirect('/account/edit')->withErrors($validacija);
        }

        //Izmena podataka ako je podatak promenjen
        if ($this->korisnik['Ime'] != $request->input('name'))
        {
            $this->korisnik['Ime'] = $request->input('name');
        }
        if ($this->korisnik['Prezime'] != $request->input('surname'))
        {
            $this->korisnik['Prezime'] = $request->input('surname');
        }
        if ($this->korisnik['Adresa'] != $request->input('address'))
        {
            $this->korisnik['Adresa'] = $request->input('address');
        }

        $this->korisnik->save();
        return redirect('/account/dashboard');
    }

    //Metoda generise token za reset sifre i salje ga korisniku(U fajlu, jer mailing nije podesen u projektu)
    function zatraziResetSifre()
    {
        //Generisanje random stringa za resetovanje sifre
        $resetString = bin2hex(random_bytes(16));
        $hashedResetString = Hash::make($resetString);
        $this->korisnik['Password_Reset_Token'] = $hashedResetString;
        $this->korisnik->save();

        $imeFajla = 'resetPassword' . $this->korisnik['ID_Korisnika'] . '.txt';
        Storage::put($imeFajla, $resetString);

        return  Storage::download($imeFajla, 'resetPassword.txt');
    }

    //Metoda proverava ispravnost reset koda, i daje mogucnost korisniku da menja sifru na 5 minuta
    function proveriResetKod(Request $request)
    {
        if (Hash::check($request->input('resetCode'), $this->korisnik['Password_Reset_Token']))
        {
            Cookie::queue('mozeDaMenjaSifru', 'da', 5);
            return view('account.passwordChange');
        }
    }

    function stranicaPromenaSifre()
    {
        if (Cookie::get('mozeDaMenjaSifru') == 'da')
        {
            return view('account.passwordChange');
        }
        else
        {
            return redirect('/account/edit')->withErrors('Token za promenu sifre je istekao!');
        }
    }

    //Metoda za promenu sifre
    function promeniSifru(Request $request)
    {
        //Provera validnosti unosa
        if ($request->input('password') == "" || $request->input('password_confirm') == "")
        {
            return redirect('/account/edit/password')->withErrors('Sva polja su obavezna!');
        }
        if (strlen($request->input('password')) < 8 || strtolower($request->input('password')) == $request->input('password') || !preg_match('~[0-9]+~', $request->input('password')))
        {
            return redirect('/account/edit/password')->withErrors('Šifra mora da ima barem 8 karaktera, sadrži veliko slovo i broj');
        }
        if ($request->input('password') != $request->input('password_confirm'))
        {
            return redirect('/account/edit/password')->withErrors('Šifre se ne poklapaju!');
        }

        //ako je token jos uvek validan, promeni sifru
        if (Cookie::get('mozeDaMenjaSifru') == 'da')
        {
            $this->korisnik['Sifra'] = Hash::make($request->input('password'));
            $this->korisnik['Password_Reset_Token'] = '';
            $this->korisnik->save();

            return view('info.passwordChangeSuccess');
        }
        else
        {
            return redirect('/account/edit')->withErrors('Token za promenu sifre je istekao!');
        }
    }
}
