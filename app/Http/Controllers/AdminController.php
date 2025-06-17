<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Korisnik, Rezervacija, Nalog, RezervisanaSedista, Promocija};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //Metoda koja vraca korisnika na pregled
    function prikaziKorisnike()
    {
        $korisnici = Korisnik::where('Uloga', '<>', 'ADMIN')->paginate(15);

        return view('admin.users', ['korisnici' => $korisnici]);
    }

    //Pretraga korisnika po ID-u ili korisnickom imenu u zavisnosti od unosa
    function pretraziKorisnike(Request $request)
    {
        if (is_numeric($request->input('pretragaPolje')))
        {
            $korisnici = Korisnik::where('ID_Korisnika', $request->input('pretragaPolje'))->where('Uloga', '<>', 'ADMIN')->paginate(15);
        }
        else
        {
            $korisnici = Korisnik::where('Korisnicko_Ime', 'LIKE', '%' . $request->input('pretragaPolje') . '%')->where('Uloga', '<>', 'ADMIN')->paginate(15);
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
    
    //Metoda koja prikazuje formu za dodavanje novog korisnika
    function noviKorisnik()
    {
        return view('admin.noviKorisnik');
    }

    //Metoda koja dodaje novog korisnika
    function dodajNovogKorisnika(Request $request)
    {
        //Validacija da li su polja uneta i korektno uneta
        if ($request->input('username') == "" || $request->input('password') == "" || $request->input('password_confirm') == "" || $request->input('name') == "" || $request->input('surname') == "" || $request->input('adress') == "")
        {
            return redirect('/admin/noviKorisnik')->withErrors('Sva polja su obavezna!');
        }
        if (str_contains($request->input('username'), ' '))
        {
            return redirect('/admin/noviKorisnik')->withErrors('Korisničko ime ne sme sadržati razmake!');
        }
        if (strlen($request->input('password')) < 8 || strtolower($request->input('password')) == $request->input('password') || !preg_match('~[0-9]+~', $request->input('password')))
        {
            return redirect('/admin/noviKorisnik')->withErrors('Šifra mora da ima barem 8 karaktera, sadrži veliko slovo i broj');
        }
        if ($request->input('password') != $request->input('password_confirm'))
        {
            return redirect('/admin/noviKorisnik')->withErrors('Šifre se ne poklapaju!');
        }

        //Provera da li je email vec u upotrebi
        $korisnikEmail = Korisnik::where('Email', $request->input('email'))->first();
        if ($korisnikEmail)
        {
            return redirect('/admin/noviKorisnik')->withErrors('email je već u upotrebi!');
        }
        //Provera da li je korisnicko ime vec u upotrebi
        $korisnikIme = Korisnik::where('Korisnicko_Ime', $request->input('username'))->first();
        if ($korisnikIme)
        {
            return redirect('/admin/noviKorisnik')->withErrors('Korisnik sa unetim korisničkim imenom već postoji!');
        }

        //kreiranje novog korisnickog naloga i ulogovanje
        $noviKorisnik = Korisnik::create(
            [
                'Korisnicko_Ime' => $request->input('username'),
                'Email' => $request->input('email'),
                'Sifra' => Hash::make($request->input('password')),
                'Ime' => $request->input('name'),
                'Prezime' => $request->input('surname'),
                'Adresa' => $request->input('adress'),
                'Uloga' => $request->input('role')
        ]);

        return redirect('/admin/users');
    }
}
