<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;

Route::get('/forgot-password', [ForgotPasswordController::class, 'show']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'store']);
Route::get('/password-reset', [PasswordResetController::class, 'show']);
Route::post('/password-reset', [PasswordResetController::class, 'store']);
Route::post('logout', LogoutController::class);
