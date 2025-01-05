<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{InstancaLeta, AvioKompanija, Avion, Sediste, Korisnik, Rezervacija, Nalog, RezervisanaSedista};
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

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
        $vecRezervisanaSedista = RezervisanaSedista::select('Br_Sedista')->where('Br_Leta', 'LIKE', '%' . $brLeta . '%')->where('Datum_Polaska', $datumPolaska)->where('Registracija', $avion['Registracija'])->get();
        $sedista = Sediste::where('Registracija', 'LIKE', '%' . $instancaLeta['Registracija'] . '%')->where('Klasa', 'LIKE', '%' . $izabranaKlasa . '%')->whereNotIn('Br_Sedista', $vecRezervisanaSedista)->get();

        return view('reservation.classAndSeat', ['instancaLeta' => $instancaLeta, 'postoji' => $postoji, 'izabranaKlasa' => $izabranaKlasa, 'avion' => $avion, 'sedista' => $sedista]);
    }

    //Metoda upisuje sve informacije o izabranim kartama i sedistima u sesiju, zatim ispisuje korisnikove informacije za potvrdu
    function upisInformacija($brLeta, $datumPolaska, $klasa, Request $request)
    {
        //Upisivanje svih izabranih sedista u niz, i cuvanje u sesiji
        $izabranaSedista = array();
        $brojKarata = $request->input('brojKarata');
        for ($i = 1; $i <= $brojKarata; $i++)
        {
            if ($request->input('sediste' . $i) != "")
            {
                $izabranaSedista[] = $request->input('sediste' . $i);
            }   
        }
        $request->session()->put('brojKarata', $brojKarata);
        $request->session()->put('izabranaSedista', $izabranaSedista);
        $request->session()->put('cenaKarte', $request->input('cenaKarte'));
        $request->session()->put('cenaDoplate', $request->input('cenaDoplate'));


        //Trazenje korisnika koji je trenutno ulogovan zbog njegovih informacija
        $korisnik = Korisnik::where('Korisnicko_Ime', Cookie::get('korisnik'))->first();

        return view('reservation.infoInput', ['brLeta' => $brLeta, 'datumPolaska' => $datumPolaska, 'klasa' => $klasa, 'korisnik' => $korisnik]);
    }

    //ponovni ispis korisnikovih informacija bez post dela, za side navbar
    function upisInformacijaGet($brLeta, $datumPolaska, $klasa, Request $request)
    {
        //Trazenje korisnika koji je trenutno ulogovan zbog njegovih informacija
        $korisnik = Korisnik::where('Korisnicko_Ime', Cookie::get('korisnik'))->first();

        return view('reservation.infoInput', ['brLeta' => $brLeta, 'datumPolaska' => $datumPolaska, 'klasa' => $klasa, 'korisnik' => $korisnik]);
    }

    //Metoda koja vraca pogled sa stranicom o svim relevantnim informacijama za potvrdu rezervacije
    function prikaziPotvrdu($brLeta, $datumPolaska, $klasa, Request $request)
    {
        //Validacija da li su polja uneta i vracanje greske ukoliko nisu
        $validacija = Validator::make($request->all(), [
            'ime' => 'required',
            'prezime' => 'required',
            'adresa' => 'required'
        ], $messages = [
            'required' => 'Sva polja su obavezna!'
        ]);
        if ($validacija->fails())
        {
            return redirect('/reservation/' . $brLeta . '/' . $datumPolaska . '/' . $klasa . '/info')->withErrors($validacija);
        }

        $informacije = array();

        $informacije['Ime'] = $request->input('ime');
        $informacije['Prezime'] = $request->input('prezime');
        $informacije['Adresa'] = $request->input('adresa');

        $instancaLeta = InstancaLeta::where('Br_Leta', 'LIKE', '%' . $brLeta . '%')->where('Datum_Polaska', $datumPolaska)->first();
        $avioKompanija = AvioKompanija::where('ICAO_Kod', 'LIKE', '%' . $instancaLeta['ICAO_Kod'] . '%')->first();

        return view('reservation.confirmation', ['instancaLeta' => $instancaLeta, 'avioKompanija' => $avioKompanija, 'klasa' => $klasa, 'informacije' => $informacije]);
    }

    //Metoda koja kreira rezervaciju, nalog, i rezervise sedista na osnovu svih unetih informacija
    function napraviRezervaciju($brLeta, $datumPolaska, $klasa, Request $request)
    {
        //Provera da li korisnik ima vec rezervaciju za ovaj let
        $korisnik = Korisnik::select('ID_Korisnika')->where('Korisnicko_Ime', Cookie::get('korisnik'))->first();
        $rezervacija = Rezervacija::where('Br_Leta', 'LIKE', '%' . $brLeta . '%')->where('Datum_Polaska', $datumPolaska)->where('ID_Korisnika', $korisnik['ID_Korisnika'])->first();
        if ($rezervacija)
        {
            return view('info.reservationExists');
        }

        //Upisivanje rezervacije u bazu
        $novaRezervacija = Rezervacija::create(
            [
                'Datum_Polaska' => $datumPolaska,
                'Br_Leta' => $brLeta,
                'ICAO_Kod' => $request->input('ICAO_Kod'),
                'ID_Korisnika' => $korisnik['ID_Korisnika'],
                'Br_Karata' => $request->session()->get('brojKarata'),
                'Klasa' => $klasa,
                'Ime' => $request->input('ime'),
                'Prezime' => $request->input('prezime'),
                'Adresa' => $request->input('adresa'),
        ]);

        //Upisivanje nalog u bazu
        Nalog::create(
            [
                'Datum_Polaska' => $novaRezervacija['Datum_Polaska'],
                'Br_Leta' => $novaRezervacija['Br_Leta'],
                'ICAO_Kod' => $novaRezervacija['ICAO_Kod'],
                'ID_Korisnika' => $novaRezervacija['ID_Korisnika'],
                'Iznos' => $request->session()->get('cenaKarte') * $request->session()->get('brojKarata') + $request->session()->get('cenaDoplate')
        ]);

        //Upisivanje rezervisanih sedista u bazu
        $izabranaSedista = $request->session()->get('izabranaSedista');
        foreach ($izabranaSedista as $sediste)
        {
            if ($sediste)
            {
                RezervisanaSedista::create(
                    [
                        'Datum_Polaska' => $novaRezervacija['Datum_Polaska'],
                        'Br_Leta' => $novaRezervacija['Br_Leta'],
                        'ICAO_Kod' => $novaRezervacija['ICAO_Kod'],
                        'ID_Korisnika' => $novaRezervacija['ID_Korisnika'],
                        'Registracija' => $request->input('registracija'),
                        'Br_Sedista' => $sediste
                ]);
            }
        }

        return view('info.reservationSuccess');

    }
}
