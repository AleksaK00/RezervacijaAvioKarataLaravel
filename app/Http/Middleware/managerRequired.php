<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;
use App\Models\Korisnik;

class managerRequired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Cookie::get('korisnik'))
        {
            return redirect('/info/loginNeeded');
        }
        
        $korisnik = Korisnik::where('Korisnicko_Ime', Cookie::get('korisnik'))->first();
        if ($korisnik['Uloga'] != 'ADMIN' && $korisnik['Uloga'] != 'MENADZER')
        {
            return redirect('/info/adminNeeded');
        }

        return $next($request);
    }
}
