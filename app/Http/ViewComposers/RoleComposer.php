<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cookie;
use App\Models\Korisnik;

//View Composer koji stavlja korisnicku ulogu dostupnu u svaki view.
class RoleComposer
{
    public function compose(View $view)
    {
        $userRole = 'GOST'; // Default uloga
        $korisnickoIme = Cookie::get('korisnik');
        $korisnik = Korisnik::where('Korisnicko_Ime', $korisnickoIme)->first();
        if ($korisnik) {
            $userRole = $korisnik['Uloga']; 
        }

        $view->with('userRole', $userRole);
    }
}