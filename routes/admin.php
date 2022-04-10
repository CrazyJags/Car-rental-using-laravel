<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\CarImagesManagementController;
use App\Http\Controllers\Admin\CarRentManagementController;
use App\Http\Controllers\Admin\CarsManagementController;
use App\Http\Controllers\Admin\ManagementHomeController;
use App\Http\Controllers\Admin\ManagementLogoutController;
use App\Http\Controllers\Admin\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'show']);
    Route::post('/login', [AdminLoginController::class, 'store']);
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [ManagementHomeController::class, 'index']);
        # Cars
        Route::get('/cars', [CarsManagementController::class, 'list'])->name('admin_cars');
        Route::post('/cars', [CarsManagementController::class, 'store']);
        Route::put('/cars/{id}', [CarsManagementController::class, 'update'])
            ->whereNumber('id');
        Route::delete('/cars/{id}', [CarsManagementController::class, 'delete'])
            ->whereNumber('id');
        # Car images
        Route::post('/cars/{id}/images', [CarImagesManagementController::class, 'store'])
            ->whereNumber('id');
        Route::delete('/car-images/{id}', [CarImagesManagementController::class, 'destroy'])
            ->whereNumber('id');
        # Car rents
        Route::get('/rents', [CarRentManagementController::class, 'list']);
        Route::delete('/rents/{id}', [CarRentManagementController::class, 'delete'])
            ->whereNumber('id');
        # Users
        Route::get('/users', [UserManagementController::class, 'list']);
        Route::delete('/users/{id}', [UserManagementController::class, 'delete'])
            ->whereNumber('id');

        Route::post('logout', ManagementLogoutController::class);
    });
});
