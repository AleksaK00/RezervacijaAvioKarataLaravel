<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{InstancaLeta, AvioKompanija};

class reservationController extends Controller
{
    function izaberiLet ($brLeta)
    {
        $instanceLeta = InstancaLeta::where('Br_Leta', 'LIKE', '%' . $brLeta .'%')->get();
        $avioKompanija = AvioKompanija::where('ICAO_Kod', 'LIKE', '%' . $instanceLeta[0]['ICAO_Kod'] .'%')->first();

        return view('reservation.flights', ['letovi' => $instanceLeta, 'avioKompanija' => $avioKompanija]);
    }
}
