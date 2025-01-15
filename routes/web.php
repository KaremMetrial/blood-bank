<?php

    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\Web\CategoryController;
    use App\Http\Controllers\Web\CityController;
    use App\Http\Controllers\Web\ClientController;
    use App\Http\Controllers\Web\ContactController;
    use App\Http\Controllers\Web\DashboardController;
    use App\Http\Controllers\Web\DonationController;
    use App\Http\Controllers\Web\GovernorateController;
    use App\Http\Controllers\Web\PermissionController;
    use App\Http\Controllers\Web\RoleController;
    use App\Http\Controllers\Web\SettingController;
    use App\Http\Controllers\Web\UserController;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "web" middleware group. Make something great!
    |
     */


    Route::middleware(['auth', 'role:admin'])->group(function () {
        // Dashboard Routes
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin'], function () {

        // Governorate Routes
        Route::resource('governorates', GovernorateController::class)->except(['show']);

        // City Routes
        Route::resource('cities', CityController::class)->except(['show']);

        // Category Routes
        Route::resource('categories', CategoryController::class)->except(['show']);

        // Client Routes
        Route::resource('clients', ClientController::class);

        // Contact Routes
        Route::resource('contacts', ContactController::class)->only(['index', 'destroy']);

        // Donation Routes
        Route::resource('donations', DonationController::class)->only(['index', 'destroy']);

        // Settings Routes
        Route::get('settings', [SettingController::class, 'settings'])->name('settings');
        Route::put('settings', [SettingController::class, 'updateSettings'])->name('settings.update');

        // Users Routes
        Route::resource('users', UserController::class)->except(['show']);

        // Roles Routes
        Route::resource('roles', RoleController::class);
    });


    require __DIR__ . '/auth.php';
