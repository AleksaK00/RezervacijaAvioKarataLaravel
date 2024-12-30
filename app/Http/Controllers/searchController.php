<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use Illuminate\Database\Eloquent\Model;

class searchController extends Controller
{

    //Puni niz rezultata pretrage i niz podataka za filter na osnovu unetog polaznog i dolaznog grada
    public function Pretraga(Request $request)
    {
        // Nalazenje svih aerodroma u polaznom i dolaznom gradu
        $unosPolazni = $request->input('polazniAerodrom');
        $unosDolazni = $request->input('dolazniAerodrom');
        $polazniAerodromi = Models\Aerodrom::where('Grad', 'LIKE', '%'.$unosPolazni.'%')->get();
        $dolazniAerodromi = Models\Aerodrom::where('Grad', 'LIKE', '%'.$unosDolazni.'%')->get();

        $pretraga = new Models\RezultatPretrage();

        //Trazi letove za sve kombinacije aerodroma, zatim ih stavlja u rezultatNiz
        foreach ($polazniAerodromi as $trenutniPolazni)
        {
            $pretraga->podaciZaFilter['polazniAerodromi'][] = $trenutniPolazni["Ime"];

            foreach ($dolazniAerodromi as $trenutniDolazni)
            {
                $pretraga->podaciZaFilter['dolazniAerodromi'][] = $trenutniDolazni["Ime"];

                $rezultat = Models\Let::where('Polazni_Aerodrom', 'LIKE', '%'.$trenutniPolazni["ICAO_Kod_Aerodroma"].'%')->where('Dolazni_Aerodrom', 'LIKE', '%'.$trenutniDolazni["ICAO_Kod_Aerodroma"].'%')->get();

                foreach ($rezultat as $trenutniLet)
                {
                    //Popunjavanje nove instance klase PojedinacniRezultat
                    $trenutniRezultat = new Models\PojedinacniRezultat();
                    $trenutniRezultat->let = $trenutniLet;
                    $trenutniRezultat->avioKompanija = Models\AvioKompanija::where('ICAO_Kod', 'LIKE', $trenutniLet['ICAO_Kod'])->first();
                    $trenutniRezultat->polazniAerodrom = $trenutniPolazni;
                    $trenutniRezultat->dolazniAerodrom = $trenutniDolazni;

                    $pretraga->rezultatNiz[] = $trenutniRezultat;

                    //Popunjavanje podataka za filtere ukoliko je potrebno
                    if ($pretraga->podaciZaFilter['minCena'] == 0 || $pretraga->podaciZaFilter['minCena'] > $trenutniRezultat->CenaOd())
                    {
                        $pretraga->podaciZaFilter['minCena'] = $trenutniRezultat->CenaOd();
                    }
                    if ($pretraga->podaciZaFilter['maxCena'] == 0 || $pretraga->podaciZaFilter['maxCena'] < $trenutniRezultat->CenaOd())
                    {
                        $pretraga->podaciZaFilter['maxCena'] = $trenutniRezultat->CenaOd();
                    }
                    if (!array_key_exists($trenutniRezultat->avioKompanija['ICAO_Kod'], $pretraga->podaciZaFilter['avioKompanije']))
                    {
                        $pretraga->podaciZaFilter['avioKompanije'][$trenutniRezultat->avioKompanija['ICAO_Kod']] = $trenutniRezultat->avioKompanija['Ime'];
                    }
                }
            }
        }

        usort($pretraga->rezultatNiz, function($a, $b) {return $a->CenaOd() > $b->CenaOd();});
        return view('search', ['pretraga' => $pretraga]);

    }
}
