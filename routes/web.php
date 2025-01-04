<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{searchController, AuthenticationController, reservationController};
use App\Http\Middleware\loginRequired;

Route::get('/', function () {
    return view('index');
});

Route::post('/search', [searchController::class, 'pretraga']);

//login i logout rute
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [AuthenticationController::class, 'login']);
Route::get('/logout', [AuthenticationController::class, 'logout']);

//Rute za registraciju
Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [AuthenticationController::class, 'register']);

//Rute za korake rezervacije
Route::get('/reservation/{brLeta}', [reservationController::class, 'izaberiLet'])->middleware(loginRequired::class);
Route::get('/reservation/{brLeta}/{datumPolaska}', [reservationController::class, 'ispisiKlase'])->middleware(loginRequired::class);
Route::get('/reservation/{brLeta}/{datumPolaska}/{klasa}', [reservationController::class, 'izborKarataSedista'])->middleware(loginRequired::class)->name('izborKarataSedista');

//Rute za jednostavne poruke
Route::get('/info/registrationSuccess', function(){
    return view('info.registrationSuccess');
});
Route::get('/info/loginNeeded', function(){
    return view('info.loginNeeded');
});
