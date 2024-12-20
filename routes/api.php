<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BloodTypeController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\GovernorateController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SettingController;
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

        // Settings routes
        Route::get('settings', [SettingController::class, 'index']);

        // Contact routes
        Route::post('contact-us', [ContactController::class, 'contact']);

        // Gategory routes
        Route::get('categories', [CategoryController::class, 'index']);

        // Blood type routes
        Route::get('blood-types', [BloodTypeController::class, 'index']);

        // Notification Setting
        Route::get('notification-setting', [NotificationController::class, 'getNotificationSetting']);
        Route::put('notification-setting/update', [NotificationController::class, 'updateNotificationSetting']);

        // Profile routes
        Route::get('/profile', [ProfileController::class, 'show']);
        Route::put('/profile/update', [ProfileController::class, 'update']);

    });
});
