<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AccountActionsController, searchController, AuthenticationController, reservationController};
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
Route::post('/reservation/{brLeta}/{datumPolaska}/{klasa}/info', [reservationController::class, 'upisInformacija'])->middleware(loginRequired::class);
Route::get('/reservation/{brLeta}/{datumPolaska}/{klasa}/info', [reservationController::class, 'upisInformacijaGet'])->middleware(loginRequired::class);
Route::post('/reservation/{brLeta}/{datumPolaska}/{klasa}/confirm', [reservationController::class, 'prikaziPotvrdu'])->middleware(loginRequired::class);
Route::post('/reservation/{brLeta}/{datumPolaska}/{klasa}/confirmed', [reservationController::class, 'napraviRezervaciju'])->middleware(loginRequired::class);

//Rute za korisnicki nalog
Route::get('/account/dashboard', [AccountActionsController::class, 'stranicaNaloga'])->middleware(loginRequired::class);
Route::get('/account/reservations', [AccountActionsController::class, 'pregledajRezervacije'])->middleware(loginRequired::class)->name('rezervacije');
Route::get('/account/edit', [AccountActionsController::class, 'stranicaIzmeni'])->middleware(loginRequired::class)->name('izmene');
Route::get('/account/delete', [AccountActionsController::class, 'obrisiNalog'])->middleware(loginRequired::class);
Route::get('/reservation/{brLeta}/{datumPolaska}/{IDkorisnika}/cancel', [reservationController::class, 'otkaziRezervaciju'])->middleware(loginRequired::class);
Route::post('/account/edit/base', [AccountActionsController::class, 'izmeniOsnovnePodatke'])->middleware(loginRequired::class);
Route::post('/account/edit/personal', [AccountActionsController::class, 'izmeniLicnePodatke'])->middleware(loginRequired::class);
Route::get('/account/edit/resetRequest', [AccountActionsController::class, 'zatraziResetSifre'])->middleware(loginRequired::class);
Route::post('/account/edit/password', [AccountActionsController::class, 'proveriResetKod'])->middleware(loginRequired::class)->name('promenaSifre');
Route::get('/account/edit/password', [AccountActionsController::class, 'stranicaPromenaSifre'])->middleware(loginRequired::class)->name('promenaSifre');
Route::post('/account/edit/password/change', [AccountActionsController::class, 'promeniSifru'])->middleware(loginRequired::class);

//Rute za jednostavne poruke
Route::get('/info/registrationSuccess', function(){
    return view('info.registrationSuccess');
});
Route::get('/info/loginNeeded', function(){
    return view('info.loginNeeded');
});
Route::get('/info/reservationSuccess', function(){
    return view('info.reservationSuccess');
});
Route::get('/info/reservationExists', function(){
    return view('info.reservationExists');
});
