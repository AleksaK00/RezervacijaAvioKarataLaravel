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
        //Autorizacija, ne ulogovani korisnik ne spe da pristupi ovoj stranici
        if (!Cookie::get('korisnik'))
        {
            return redirect('/info/loginNeededReservation');
        }

        //trazi sve instance leta posle trenutnog datuma
        $instanceLeta = InstancaLeta::where('Br_Leta', 'LIKE', '%' . $brLeta .'%')->where('Datum_Polaska', '>', date('Y-m-d'))->orderBy('Datum_Polaska', 'asc')->get();
        $avioKompanija = AvioKompanija::where('ICAO_Kod', 'LIKE', '%' . $instanceLeta[0]['ICAO_Kod'] .'%')->first();

        return view('reservation.flights', ['letovi' => $instanceLeta, 'avioKompanija' => $avioKompanija, 'brLeta' => $brLeta]);
    }
}
