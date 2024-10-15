<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CitaController;


//opciones inicio
Route::get('/', [AuthController::class, 'showAuthOptions'])->name('auth.options');
//registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
//login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//home
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
//perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

//citas
Route::prefix('citas')->group(function () {
    Route::get('create', [CitaController::class, 'create'])->name('citas.create');
    Route::post('filtrar', [CitaController::class, 'filtrar'])->name('citas.filtrar');
    Route::post('store', [CitaController::class, 'store'])->name('citas.store');
    Route::get('/citas/ver', [CitaController::class, 'verCitas'])->name('citas.ver')->middleware('auth');
    Route::delete('/citas/{id}/cancelar', [CitaController::class, 'cancelar'])->name('citas.cancelar');

});