<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;

class loginRequired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     //proverava da li je korisnik prijavljen, vraca poruku koja ga upucuje na login ako nije
    public function handle(Request $request, Closure $next): Response
    {
        if (!Cookie::get('korisnik'))
        {
            return redirect('/info/loginNeeded');
        }

        return $next($request);
    }
}
