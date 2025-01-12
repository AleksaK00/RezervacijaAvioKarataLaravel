<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Korisnik, Rezervacija, Nalog, RezervisanaSedista, Promocija};
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //Metoda koja vraca korisnika na pregled
    function prikaziKorisnike()
    {
        $korisnici = Korisnik::where('Administrator', '<>', 1)->paginate(15);

        return view('admin.users', ['korisnici' => $korisnici]);
    }

    //Pretraga korisnika po ID-u ili korisnickom imenu u zavisnosti od unosa
    function pretraziKorisnike(Request $request)
    {
        if (is_numeric($request->input('pretragaPolje')))
        {
            $korisnici = Korisnik::where('ID_Korisnika', $request->input('pretragaPolje'))->where('Administrator', '<>', 1)->paginate(15);
        }
        else
        {
            $korisnici = Korisnik::where('Korisnicko_Ime', 'LIKE', '%' . $request->input('pretragaPolje') . '%')->where('Administrator', '<>', 1)->paginate(15);
        }

        return view('admin.users', ['korisnici' => $korisnici]);
    }

    //Metoda koja gasi nalog korisnika, prvo pravilnim redosledom brise rezervisana sedista i otkazuje rezervaciju
    function ugasiNalog($IDkorisnika)
    {
        RezervisanaSedista::where('ID_Korisnika', $IDkorisnika)->delete();

        $rezervacije = Rezervacija::where('ID_Korisnika', $IDkorisnika)->get();
        foreach ($rezervacije as $rezervacija)
        {
            $rezervacija['Otkazana'] = 1;
            $rezervacija->save();
        }

        $korisnik = Korisnik::where('ID_Korisnika', $IDkorisnika)->first();
        $korisnik['Is_Deleted'] = 1;
        $korisnik->save();

        return redirect('/admin/users');
    }

    //Metoda koja vraca korisnicki nalog na neobrisani status
    function vratiNalog($IDkorisnika)
    {
        $korisnik = Korisnik::where('ID_Korisnika', $IDkorisnika)->first();
        $korisnik['Is_Deleted'] = 0;
        $korisnik->save();

        return redirect('/admin/users');
    }

    //Metoda koja u potpunosti brise nalog, prvo pravilnim redosledom brise rezervisana sedista, naloge i rezervacije
    function obrisiNalog($IDkorisnika)
    {
        RezervisanaSedista::where('ID_Korisnika', $IDkorisnika)->delete();
        Nalog::where('ID_Korisnika', $IDkorisnika)->delete();
        Rezervacija::where('ID_Korisnika', $IDkorisnika)->delete();
        Korisnik::where('ID_Korisnika', $IDkorisnika)->delete();

        return redirect('/admin/users');
    }

    //Metoda za promenu korisnickog imena od strane admina
    function promeniIme($IDkorisnika, Request $request)
    {
        $imePolja = 'novoKorisnickoIme' . $IDkorisnika;

        //validacija polja
        $validacija = Validator::make($request->all(), [
            $imePolja => 'required|alpha_dash',
        ], $messages = [
            'required' => 'Sva polja su obavezna!',
            'alpha_dash' => 'Korisnicko ime ne sme da ima razmak!',
        ]);

        if ($validacija->fails())
        {
            return redirect('/admin/users')->withErrors($validacija);
        }

        $korisnik = Korisnik::where('ID_Korisnika', $IDkorisnika)->first();

        //Ukoliko je admin uneo novo korisnicko ime, proverava da li je slobodno i menja ga ako jeste
        if ($korisnik['Korisnicko_Ime'] != $request->input($imePolja))
        {
            $korisnikProvera = Korisnik::where('Korisnicko_Ime', $request->input($imePolja))->first();
            if ($korisnikProvera)
            {
                return redirect('/admin/users')->withErrors('Novo korisnicko ime je zauzeto!');
            }
            else
            {
                $korisnik['Korisnicko_Ime'] = $request->input($imePolja);
                $korisnik->save();
            }
        }

        return redirect('/admin/users');
    }

    //Metoda koja prikazuje sve rezervacije i korisnicko ime rezervacije
    function prikaziRezervacije()
    {
        $rezervacije = Rezervacija::join('korisnik', 'rezervacija.ID_Korisnika', '=', 'korisnik.ID_Korisnika')->select('rezervacija.*', 'korisnik.Korisnicko_Ime as KorisnickoIme')->paginate(15);

        //Racunanje broja dana do polaska za svaku rezervaciju
        foreach ($rezervacije as $rezervacija)
        {
            $danaDo = Carbon::now()->diffInDays($rezervacija['Datum_Polaska']);
            $rezervacija['danaDo'] = $danaDo;
        }

        return view('admin.reservations', ['rezervacije' => $rezervacije]);
    }

    //Metoda koja pretrazuje rezervacije po koriscnickom imenu
    function pretraziRezervacije(Request $request)
    {
        $korisnici = Korisnik::where('Korisnicko_Ime', 'LIKE', '%' . $request->input('pretragaPolje') . '%')->select('ID_Korisnika')->get();

        $rezervacije = Rezervacija::whereIn('rezervacija.ID_Korisnika', $korisnici)->join('korisnik', 'rezervacija.ID_Korisnika', '=', 'korisnik.ID_Korisnika')
         ->select('rezervacija.*', 'korisnik.Korisnicko_Ime as KorisnickoIme')->paginate(15);

        //Racunanje broja dana do polaska za svaku rezervaciju
        foreach ($rezervacije as $rezervacija)
        {
            $danaDo = Carbon::now()->diffInDays($rezervacija['Datum_Polaska']);
            $rezervacija['danaDo'] = $danaDo;
        }

        return view('admin.reservations', ['rezervacije' => $rezervacije]);
    }

    //Metoda koja otkazuje zadatu rezervaciju
    function otkaziRezervaciju($brLeta, $datumPolaska , $IDkorisnika)
    {
        $rezervacija = Rezervacija::where('Br_Leta', 'LIKE', '%' . $brLeta . '%')->where('Datum_Polaska', $datumPolaska)->where('ID_Korisnika', $IDkorisnika)->first();
        $rezervacija['Otkazana'] = 1;
        $rezervacija->save();

        //Brisanje rezervisanih
        RezervisanaSedista::where('Br_Leta', 'LIKE', '%' . $brLeta . '%')->where('Datum_Polaska', $datumPolaska)->where('ID_Korisnika', $IDkorisnika)->delete();

        return redirect('/admin/reservations'); 
    }

    //Metoda koja ispisuje stranicu za upravljanje promocija
    function upravljajPromocijama()
    {
        $promocije = Promocija::all();

        return view('admin.promoManagment', ['promocije' => $promocije]);
    }

    //Metoda koja ubacuje novu promociju
    function novaPromocija(Request $request)
    {
        //validacija polja
        $validacija = Validator::make($request->all(), [
            'destinacijaUnos' => 'required',
            'tekstUnos' => 'required',
            'slikaUnos' => 'required|mimes:jpg'
        ], $messages = [
            'required' => 'Sva polja su obavezna!',
            'mimes' => 'slika mora da bude JPG'
        ]);

        if ($validacija->fails())
        {
            return redirect('/admin/promos')->withErrors($validacija);
        }

        //Ubacivanje nove promocije, osim ako promocija za grad vec postoji
        $promocijaPostoji = Promocija::where('Destinacija', $request->input('destinacijaUnos'))->first();
        if ($promocijaPostoji)
        {
            return redirect('/admin/promos')->withErrors('Promocija već postoji u bazi, obriši postojeću za unos nove verzije');
        }
        else
        {
            $novaPromocija = Promocija::create([
                'Destinacija' => $request->input('destinacijaUnos'),
                'Tekst' => $request->input('tekstUnos'),
                'Aktivan_Slot' => NULL
            ]);

            //prebacivanje slike u folder public/images/Promo
            $request->slikaUnos->move(public_path('images/Promo'), $novaPromocija['Destinacija'] . '.jpg');
        }

        return redirect('/admin/promos');
    }

    //Metoda za brisanje promocije
    public function obrisiPromociju($IDpromocije)
    {
        $promocija = Promocija::where('ID', $IDpromocije)->first();
        Storage::disk('images')->delete('Promo/' . $promocija['Destinacija'] . '.jpg');
        $promocija->delete();

        return redirect('/admin/promos');
    }
}
