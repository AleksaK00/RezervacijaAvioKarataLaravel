<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\searchController;

Route::get('/', function () {
    return view('index');
});

Route::post('/search', [searchController::class, 'pretraga']);

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});
