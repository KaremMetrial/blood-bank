<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BloodTypeController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\DonationRequestController;
use App\Http\Controllers\Api\GovernorateController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PostController;
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
        // Authentication routes
        Route::post('register', 'register');
        Route::post('login', 'login');

        // Password reset routes
        Route::post('reset-password', 'resetPassword');
        // Password reset routes
        Route::post('new-password', 'newPassword');

    });

    // Governorate routes
    Route::get('governorates', [GovernorateController::class, 'index']);

    // City routes
    Route::get('cities', [CityController::class, 'index']);

    // Settings routes
    Route::get('settings', [SettingController::class, 'index']);

    // Gategory routes
    Route::get('categories', [CategoryController::class, 'index']);

    // Blood type routes
    Route::get('blood-types', [BloodTypeController::class, 'index']);

    // Protected routes
    Route::middleware('auth:api')->group(function () {

        Route::controller(AuthController::class)->group(function () {
            // Logout routes
            Route::post('logout', 'logout');
        });

        // Contact routes
        Route::post('contact-us', [ContactController::class, 'contact']);

        // Notification Setting
        Route::get('notification-setting', [NotificationController::class, 'getNotificationSetting']);
        Route::put('notification-setting/update', [NotificationController::class, 'updateNotificationSetting']);


        // Profile routes
        Route::get('/profile', [ProfileController::class, 'show']);
        Route::put('/profile/update', [ProfileController::class, 'update']);

        // Posts routes
        Route::get('/posts', [PostController::class, 'index']);
        Route::get('/posts/{id}', [PostController::class, 'show']);

        // Favorites routes
        Route::post('/add-favorites', [PostController::class, 'addToFavorites']);
        Route::get('/favorites', [PostController::class, 'getFavorites']);

        // Donation requests routes
        Route::get('/donation-requests', [DonationRequestController::class, 'index']);
        Route::get('/donation-requests/{id}', [DonationRequestController::class, 'show']);
        Route::post('/donation-requests', [DonationRequestController::class, 'store']);

        // Create token for donation request
        Route::post('create-token', [DonationRequestController::class, 'createToken']);
        Route::delete('remove-token', [DonationRequestController::class, 'removeToken']);

        // notifications routes
        Route::get('/notifications',[NotificationController::class,'index']);

    });
});
