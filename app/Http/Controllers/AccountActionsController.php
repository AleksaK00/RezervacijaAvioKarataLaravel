<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\{Korisnik, Rezervacija};

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

    public function pregledajRezervacije()
    {
        return view('account.reservations');
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
