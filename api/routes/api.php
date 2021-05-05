<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\SaleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{movie}', [MovieController::class, 'show']);

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/signup', [AuthController::class, 'signup']);

    Route::middleware(['auth:api'])->group(function () {
        Route::get('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'user']);
        Route::get('/users', [AuthController::class, 'users']);
        Route::post('/register', [AuthController::class, 'register']);
    });
});

Route::middleware(['auth:api'])->group(function () {
    // Movie routes
    Route::post('/movies', [MovieController::class, 'store']);
    Route::put('/movies/{movie}', [MovieController::class, 'update']);
    Route::put('/movies/remove/{movie}', [MovieController::class, 'vacancy']);
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy']);

    // Rent routes
    Route::get('/rents', [RentController::class, 'index']);
    Route::post('/rents/{rent}', [RentController::class, 'store']);
    Route::get('/rents/user', [RentController::class, 'userrents']);
    Route::get('/rents/{rent}', [RentController::class, 'show']);

    // Sales routes
    Route::get('/sales', [SaleController::class, 'index']);
    Route::post('/sales/{movie}', [SaleController::class, 'store']);
    Route::get('/sales/user', [SaleController::class, 'usersales']);
    Route::get('/sales/{sale}', [SaleController::class, 'show']);
});




