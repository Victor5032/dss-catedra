<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\AlquilerController;

Route::get('/', [InicioController::class, 'inicio'])->name('home');

// Urls de identificación
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('logged');
Route::get('/signup', [AuthController::class, 'index'])->name('registro');
Route::post('/signup', [AuthController::class, 'registrar'])->name('registrar');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/profile', [AuthController::class, 'perfil'])->name('perfil');

// urls de las peliculas
Route::get('/movie', [CatalogoController::class, 'catalogo'])->name('catalogo');
Route::get('/movie/{movie}', [CatalogoController::class, 'pelicula'])->name('movie');

// url de administración del inventario
Route::get('/stock', [CatalogoController::class, 'inventario'])->name('inventario');
Route::get('/stock/{movie}/{action}', [CatalogoController::class, 'inhabilitar'])->name('inhabilitar');
Route::get('/stock/add', function () {
    $route = route('ingresar');
    return view('formulario_pelicula', compact('route'));
})->name('agregar');
Route::get('/stock/{movie}', [CatalogoController::class, 'editar'])->name('editar');
Route::post('/stock/{movie}', [CatalogoController::class, 'actualizar'])->name('actualizar');
Route::post('/stock/add', [CatalogoController::class, 'agregar'])->name('ingresar');
Route::get('/stock/add/delete/{movie}', [CatalogoController::class, 'eliminar'])->name('eliminar');

// Url para mantenimiento de los administradores
Route::get('/admin', [AdminController::class, 'administradores'])->name('administradores');
Route::get('/admin/new', function () {
    return view('formulario_admin');
})->name('nuevo');
Route::post('/admin/new', [AdminController::class, 'nuevo'])->name('newadmin');

// Url para las compras
Route::get('/sales', [CompraController::class, 'compras'])->name('compras');
Route::get('/sales/details/{sale}', [CompraController::class, 'detalles'])->name('detallescompra');
Route::get('/sale/{movie}', [CompraController::class, 'comprar'])->name('comprar');

// Urls para los alquileres
Route::get('/rents', [AlquilerController::class, 'alquileres'])->name('alquileres');
Route::get('/rents/details/{rent}', [AlquilerController::class, 'detalles'])->name('detallesalquiler');
Route::get('/rent/{movie}', [AlquilerController::class, 'alquiler'])->name('alquiler');
