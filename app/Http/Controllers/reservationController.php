<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{InstancaLeta, AvioKompanija};
use Illuminate\Support\Facades\Cookie;

class reservationController extends Controller
{
    //Metoda koja ispisuje stranicu sa svim dostupnim odrzavanjima izabranog leta kasniji od trenutnog datuma 
    function izaberiLet ($brLeta)
    {
        //Autorizacija, ne ulogovani korisnik ne sme da pristupi ovoj stranici
        if (!Cookie::get('korisnik'))
        {
            return redirect('/info/loginNeededReservation');
        }

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

        return view('reservation.classAndSeat', ['instancaLeta' => $instancaLeta, 'postoji' => $postoji]);
    }
}
