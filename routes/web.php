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
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\AdminCitaController;

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
Route::middleware('auth')->group(function () {
    Route::get('/citas/agendar', [CitaController::class, 'create'])->name('citas.agendar');
    Route::post('/citas/filtrar', [CitaController::class, 'filtrar'])->name('citas.filtrar');
    Route::post('/citas/store', [CitaController::class, 'store'])->name('citas.store');
    Route::get('/citas/cliente', [CitaController::class, 'verCitasCliente'])->name('citas.cliente');
    Route::get('/citas/barbero', [CitaController::class, 'verCitasBarbero'])->name('citas.barbero');
    Route::get('/citas/ver', [CitaController::class, 'verCitas'])->name('citas.ver');
    Route::delete('/citas/{id}/cancelar', [CitaController::class, 'cancelar'])->name('citas.cancelar');
    Route::patch('/citas/{cita}/update-estado', [CitaController::class, 'updateEstado'])->name('citas.updateEstado');


    Route::prefix('admin/citas')->name('admin.citas.')->group(function () {
        Route::get('/', [AdminCitaController::class, 'index'])->name('index');
        Route::get('/create', [AdminCitaController::class, 'create'])->name('create');
        Route::post('/filtrar', [AdminCitaController::class, 'filtrar'])->name('filtrar'); // Agrega esta línea
        Route::post('/store', [AdminCitaController::class, 'store'])->name('store');
        Route::get('/{cita}', [AdminCitaController::class, 'show'])->name('show');
        Route::get('/{cita}/edit', [AdminCitaController::class, 'edit'])->name('edit');
        Route::patch('/{cita}', [AdminCitaController::class, 'update'])->name('update');
        Route::delete('/{cita}', [AdminCitaController::class, 'destroy'])->name('destroy');
    });
    
});

// Tienda
Route::middleware('auth')->group(function () {
    Route::get('tienda', [ProductController::class, 'index'])->name('tienda.index');
    Route::get('/tienda/{id}', [ProductController::class, 'show'])->name('tienda.show');
});

//crud productos
Route::prefix('admin/productos')->group(function () {
    Route::resource('productos', AdminProductController::class)->middleware('auth');    
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

Route::resource('gestion', YourCRUDController::class);
Route::resource('usuarios', UserController::class);
Route::resource('servicios', ServicioController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('marcas', MarcaController::class);
