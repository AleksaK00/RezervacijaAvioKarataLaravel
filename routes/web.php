<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AccountActionsController, AdminController, searchController, AuthenticationController, ManagerController, reservationController};
use App\Http\Middleware\{loginRequired, adminRequired, managerRequired};
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

Route::middleware([loginRequired::class])->group(function () {
    //Rute za korake rezervacije
    Route::get('/reservation/{brLeta}', [reservationController::class, 'izaberiLet']);
    Route::get('/reservation/{brLeta}/{datumPolaska}', [reservationController::class, 'ispisiKlase']);
    Route::get('/reservation/{brLeta}/{datumPolaska}/{klasa}', [reservationController::class, 'izborKarataSedista'])->name('izborKarataSedista');
    Route::post('/reservation/{brLeta}/{datumPolaska}/{klasa}/info', [reservationController::class, 'upisInformacija']);
    Route::get('/reservation/{brLeta}/{datumPolaska}/{klasa}/info', [reservationController::class, 'upisInformacijaGet']);
    Route::post('/reservation/{brLeta}/{datumPolaska}/{klasa}/confirm', [reservationController::class, 'prikaziPotvrdu']);
    Route::post('/reservation/{brLeta}/{datumPolaska}/{klasa}/confirmed', [reservationController::class, 'napraviRezervaciju']);

    //Rute za korisnicki nalog
    Route::get('/account/dashboard', [AccountActionsController::class, 'stranicaNaloga']);
    Route::get('/account/reservations', [AccountActionsController::class, 'pregledajRezervacije'])->name('rezervacije');
    Route::get('/account/edit', [AccountActionsController::class, 'stranicaIzmeni'])->name('izmene');
    Route::get('/account/delete', [AccountActionsController::class, 'obrisiNalog']);
    Route::get('/reservation/{brLeta}/{datumPolaska}/{IDkorisnika}/cancel', [reservationController::class, 'otkaziRezervaciju']);
    Route::post('/account/edit/base', [AccountActionsController::class, 'izmeniOsnovnePodatke']);
    Route::post('/account/edit/personal', [AccountActionsController::class, 'izmeniLicnePodatke']);
    Route::get('/account/edit/resetRequest', [AccountActionsController::class, 'zatraziResetSifre']);
    Route::post('/account/edit/password', [AccountActionsController::class, 'proveriResetKod']);
    Route::get('/account/edit/password', [AccountActionsController::class, 'stranicaPromenaSifre']);
    Route::post('/account/edit/password/change', [AccountActionsController::class, 'promeniSifru']);
});

//Rute za menadzera
Route::middleware([managerRequired::class])->group(function () {
    Route::get('/manager/dashboard', [ManagerController::class, 'prikaziDashboard']);
    Route::get('/manager/reservations', [ManagerController::class, 'prikaziRezervacije'])->name('adminRezervacije');
    Route::post('/manager/reservations', [ManagerController::class, 'pretraziRezervacije'])->name('adminRezervacije');
    Route::get('/manager/reservations/{brLeta}/{datumPolaska}/{IDkorisnika}/cancel', [ManagerController::class, 'otkaziRezervaciju']);
    Route::get('/manager/promos', [ManagerController::class, 'upravljajPromocijama'])->name('adminPromocije');
    Route::post('/manager/promos/new', [ManagerController::class, 'novaPromocija']);
    Route::post('/manager/promos/change', [ManagerController::class, 'izmeniAktivnePromocije']);
    Route::get('/manager/promos/delete/{IDpromocije}', [ManagerController::class, 'obrisiPromociju']);
});

//Rute za administratora
Route::middleware([adminRequired::class])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'prikaziKorisnike'])->name('adminKorisnici');
    Route::post('/admin/users', [AdminController::class, 'pretraziKorisnike'])->name('adminKorisnici');
    Route::get('/admin/shutDown/{IDKorisnika}', [AdminController::class, 'ugasiNalog']);
    Route::get('/admin/delete/{IDKorisnika}', [AdminController::class, 'obrisiNalog']);
    Route::get('/admin/return/{IDKorisnika}', [AdminController::class, 'vratiNalog']);
    Route::post('/admin/changename/{IDKorisnika}', [AdminController::class, 'promeniIme']);
    Route::get('/admin/noviKorisnik', [AdminController::class, 'noviKorisnik'])->name('adminNoviKorisnik');
    Route::post('/admin/noviKorisnik', [AdminController::class, 'dodajNovogKorisnika']);
});

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
