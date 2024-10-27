<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\YourCRUDController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminCitaController;
use App\Http\Controllers\MarcaController;

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
    Route::get('agendar', [CitaController::class, 'create'])->name('citas.agendar');
    Route::post('filtrar', [CitaController::class, 'filtrar'])->name('citas.filtrar');
    Route::post('store', [CitaController::class, 'store'])->name('citas.store');
    Route::get('/ver', [CitaController::class, 'verCitas'])->name('citas.ver')->middleware('auth');
    Route::delete('/{id}/cancelar', [CitaController::class, 'cancelar'])->name('citas.cancelar');
});

// Tienda
Route::middleware('auth')->group(function () {
    Route::get('tienda', [ProductController::class, 'index'])->name('tienda.index');
    Route::get('/tienda/{id}', [ProductController::class, 'show'])->name('tienda.show');
});

//carrito
Route::middleware('auth')->group(function () {

    Route::get('/carrito', [CarritoController::class, 'mostrar'])->name('carrito.mostrar');
    Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::post('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::post('/carrito/sumar/{id}', [CarritoController::class, 'sumar'])->name('carrito.sumar');
    Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
    
});

//CRUD  

Route::resource('gestion', YourCRUDController::class)->middleware('auth');
Route::resource('usuarios', UserController::class)->middleware('auth');
Route::resource('servicios', ServicioController::class)->middleware('auth');
Route::resource('categorias', CategoriaController::class)->middleware('auth');
Route::resource('productos', AdminProductController::class)->middleware('auth');
Route::resource('citas', AdminCitaController::class)->middleware('auth');
Route::resource('marcas', MarcaController::class)->middleware('auth');
