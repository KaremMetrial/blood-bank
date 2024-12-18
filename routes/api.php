<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\GovernorateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::prefix('v1')->group(function () {
    // Public routes
    Route::controller(AuthController::class)->group(function () {

        Route::post('register', 'register');
        Route::post('login', 'login');

    });

    // Protected routes
    Route::middleware('auth:api')->group(function () {

        Route::controller(AuthController::class)->group(function () {
            // Logout routes
            Route::post('logout', 'logout');
            // Password reset routes
            Route::post('reset-password', 'resetPassword');
            Route::post('new-password', 'newPassword');
        });

        // Governorate routes
        Route::get('governorates', [GovernorateController::class, 'index']);

        // City routes
        Route::get('cities', [CityController::class, 'index']);

    });
});
