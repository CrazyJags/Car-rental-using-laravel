<?php

use App\Http\Controllers\CarRentController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserRegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [UserRegisterController::class, 'show']);
Route::post('/register', [UserRegisterController::class, 'store']);
Route::get('/login', [UserLoginController::class, 'show'])->name('login');
Route::post('/login', [UserLoginController::class, 'store']);

Route::get('/', HomeController::class);
Route::get('/cars', [CarsController::class, 'list']);
Route::get('/cars/{id}', [CarsController::class, 'show'])
    ->whereNumber('id');

Route::middleware('auth')->group(function () {
    # Rents
    Route::get('/rents', [CarRentController::class, 'show'])
        ->whereNumber('id');
    Route::post('/cars/{id}/available', [CarRentController::class, 'isAvailable'])
        ->whereNumber('id');
    Route::post('/cars/{id}/rent', [CarRentController::class, 'rent'])
        ->whereNumber('id');
    Route::delete('/rents/{id}', [CarRentController::class, 'cancelRent'])
        ->whereNumber('id');
});
