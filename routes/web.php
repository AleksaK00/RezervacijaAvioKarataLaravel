<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AccountActionsController, AdminController, searchController, AuthenticationController, reservationController};
use App\Http\Middleware\{loginRequired, adminRequired};
use App\Models\Promocija;

//Index ruta, preuzima promocije
Route::get('/', function () {
    $promocije = Promocija::where('Aktivan_Slot', '>', 0)->orderBy('Aktivan_Slot', 'asc')->get();
    return view('index', ['promocije' => $promocije]);
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

//Rute za administratora
Route::get('/admin/users', [AdminController::class, 'prikaziKorisnike'])->middleware(adminRequired::class)->name('adminKorisnici');
Route::post('/admin/users', [AdminController::class, 'pretraziKorisnike'])->middleware(adminRequired::class)->name('adminKorisnici');
Route::get('/admin/shutDown/{IDKorisnika}', [AdminController::class, 'ugasiNalog'])->middleware(adminRequired::class);
Route::get('/admin/delete/{IDKorisnika}', [AdminController::class, 'obrisiNalog'])->middleware(adminRequired::class);
Route::get('/admin/return/{IDKorisnika}', [AdminController::class, 'vratiNalog'])->middleware(adminRequired::class);
Route::post('/admin/changename/{IDKorisnika}', [AdminController::class, 'promeniIme'])->middleware(adminRequired::class);
Route::get('/admin/reservations', [AdminController::class, 'prikaziRezervacije'])->middleware(adminRequired::class)->name('adminRezervacije');
Route::post('admin/reservations', [AdminController::class, 'pretraziRezervacije'])->middleware(adminRequired::class)->name('adminRezervacije');
Route::get('/admin/reservations/{brLeta}/{datumPolaska}/{IDkorisnika}/cancel', [AdminController::class, 'otkaziRezervaciju'])->middleware(adminRequired::class);
Route::get('/admin/promos', [AdminController::class, 'upravljajPromocijama'])->middleware(adminRequired::class);

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
Route::get('/info/adminNeeded', function(){
    return view('info.adminNeeded');
});
