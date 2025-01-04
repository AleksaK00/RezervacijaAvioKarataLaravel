<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{InstancaLeta, AvioKompanija, Avion, Sediste};
use Illuminate\Support\Facades\Cookie;

class reservationController extends Controller
{
    //Metoda koja ispisuje stranicu sa svim dostupnim odrzavanjima izabranog leta kasniji od trenutnog datuma 
    function izaberiLet ($brLeta)
    {

        //trazi sve instance leta posle trenutnog datuma
        $instanceLeta = InstancaLeta::where('Br_Leta', 'LIKE', '%' . $brLeta .'%')->where('Datum_Polaska', '>', date('Y-m-d'))->orderBy('Datum_Polaska', 'asc')->get();
        $avioKompanija = AvioKompanija::where('ICAO_Kod', 'LIKE', '%' . $instanceLeta[0]['ICAO_Kod'] .'%')->first();

        return view('reservation.flights', ['letovi' => $instanceLeta, 'avioKompanija' => $avioKompanija, 'brLeta' => $brLeta]);
    }

    //Metoda koja vraca instancu leta, kao i koje klase korisnik moze da rezervise, pogledu za odabir klase i sedista
    function ispisiKlase($brLeta, $datumPolaska)
    {
        $instancaLeta = InstancaLeta::where('Br_Leta', 'LIKE', '%' . $brLeta . '%')->where('Datum_Polaska', $datumPolaska)->first();
        $postoji = array('Premium_Ekonomija' => 'false', 'Biznis' => 'false');
        if (!$instancaLeta['Cena_Premium_Ekonomija'])
        {
            $postoji['Premium_Ekonomija'] = 'true';
        }
        if (!$instancaLeta['Cena_Biznis'])
        {
            $postoji['Biznis'] = 'true';
        }

        $izabranaKlasa = "";
        return view('reservation.classAndSeat', ['instancaLeta' => $instancaLeta, 'postoji' => $postoji, 'izabranaKlasa' => $izabranaKlasa]);
    }

    //Metoda koja vraca instancu leta, klase koje korisnik moze da rezervise, i dostupna sedista za odabranu klasu
    function izborKarataSedista($brLeta, $datumPolaska, $klasa)
    {
        $instancaLeta = InstancaLeta::where('Br_Leta', 'LIKE', '%' . $brLeta . '%')->where('Datum_Polaska', $datumPolaska)->first();
        $postoji = array('Premium_Ekonomija' => 'false', 'Biznis' => 'false');
        if (!$instancaLeta['Cena_Premium_Ekonomija'])
        {
            $postoji['Premium_Ekonomija'] = 'true';
        }
        if (!$instancaLeta['Cena_Biznis'])
        {
            $postoji['Biznis'] = 'true';
        }

        //Pronalazenje dostupnih sedista i aviona koji obavlja let
        $izabranaKlasa = $klasa;
        $avion = Avion::where('Registracija', 'LIKE', '%' . $instancaLeta['Registracija'] . '%')->first();
        $sedista = Sediste::where('Registracija', 'LIKE', '%' . $instancaLeta['Registracija'] . '%')->where('Klasa', 'LIKE', '%' . $izabranaKlasa . '%')->get();
        return view('reservation.classAndSeat', ['instancaLeta' => $instancaLeta, 'postoji' => $postoji, 'izabranaKlasa' => $izabranaKlasa, 'avion' => $avion, 'sedista' => $sedista]);
    }
}
