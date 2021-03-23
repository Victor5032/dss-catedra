<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	// Mensaje a retornar
	$message = "Hola mundo, esta es un POC";

	// Retornamos la vista hola que se encuentra en la carpeta pages/
	return view('pages.hola', compact('message'));
})->name('home');

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');

Route::group(['middleware' => ['jwt.verify']], function() {
	/* Rutas privadas solo para JWT */
});
