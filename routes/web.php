<?php

use App\Http\Controllers\Web\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('usuarios', UsuarioController::class);

Route::get('/buscar', function () {
    return view('usuarios.index');
})->name('buscar');

Route::get('/buscar2', function () {
    return view('usuarios.index');
})->name('register');

Route::get('/buscar3', function () {
    return view('usuarios.index');
})->name('login');