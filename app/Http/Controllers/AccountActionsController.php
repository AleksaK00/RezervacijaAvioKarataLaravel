<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\{Korisnik, Rezervacija};
use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;

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
        return view('account.edit');
    }

    //Metoda za brisanje naloga, postavljanjem vrednosti polja isDeleted na 1
    public function obrisiNalog()
    {
        $this->korisnik['Is_Deleted'] = 1;
        $this->korisnik->save();

        return redirect('/logout');
    }
}
