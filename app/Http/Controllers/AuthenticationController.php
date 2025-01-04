<?php

namespace App\Http\Controllers;

use App\Models\Korisnik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rules\Password;

class AuthenticationController extends Controller
{
    //Metoda za prijavljivanje korisnika, ubacuje korisnika u cookie na 30 dana, izbacuje greske u slucaju nevalidnih podataka
    function login(Request $request)
    {
        //Validacija da li su polja uneta i vracanje greske ukoliko nisu
        $validacija = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ], $messages = [
            'required' => 'Sva polja su obavezna!'
        ]);

        if ($validacija->fails())
        {
            return redirect('/login')->withErrors($validacija);
        }

        //Provera da li korisnik postoji u bazi
        $korisnik = Korisnik::where('Korisnicko_Ime', 'LIKE', $request->input('username'))->first();
        if (!$korisnik)
        {
            return redirect('/login')->withErrors('Ne ispravna sifra ili korisnicko ime!');
        }
        else
        {
            //proverava ispravnost sifre
            $hashProvera = Hash::check($request->input('password'), $korisnik['Sifra']);
            if (!$hashProvera)
            {
                return redirect('/login')->withErrors('Ne ispravna sifra ili korisnicko ime!');
            }
            //postavljanje cookia u slucaju da postoji i vracanje na pocetnu stranu
            Cookie::queue('korisnik', $korisnik['Korisnicko_Ime'], 10080);
            return redirect('/');
        }
    }

    //logout korisnika brisanjem cookia
    function logout()
    {
        Cookie::queue(Cookie::forget('korisnik'));
        return redirect('/');
    }

    //Metoda za registrovanje novog korisnika
    function register(Request $request)
    {
        //Validacija da li su polja uneta i korektno uneta
        if ($request->input('username') == "" || $request->input('password') == "" || $request->input('password_confirm') == "" || $request->input('name') == "" || $request->input('surname') == "" || $request->input('adress') == "")
        {
            return redirect('/register')->withErrors('Sva polja su obavezna!');
        }
        if (strlen($request->input('password')) < 8 || strtolower($request->input('password')) == $request->input('password') || !preg_match('~[0-9]+~', $request->input('password')))
        {
            return redirect('/register')->withErrors('Šifra mora da ima barem 8 karaktera, sadrži veliko slovo i broj');
        }
        if ($request->input('password') != $request->input('password_confirm'))
        {
            return redirect('/register')->withErrors('Šifre se ne poklapaju!');
        }

        //Provera da li je korisnicko ime i email vec u upotrebi
        $korisnikIme = Korisnik::where('Korisnicko_Ime', $request->input('username'))->first();
        $korisnikEmail = Korisnik::where('Email', $request->input('email'))->first();
        if ($korisnikIme)
        {
            return redirect('/register')->withErrors('Korisnik sa unetim korisničkim imenom već postoji!');
        }
        if ($korisnikEmail)
        {
            return redirect('/register')->withErrors('email je već u upotrebi!');
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
                'Administrator' => 0
        ]);
        Cookie::queue('korisnik', $noviKorisnik['Korisnicko_Ime'], 10080);

        return redirect('/info/registrationSuccess');
    }
}
