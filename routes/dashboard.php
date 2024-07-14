<?php

use App\Http\Controllers\Dashboard\{
    AdminController,
    AuthController,

    DashboardController,

    RoleController,
    SettingController,
    UserController
};


use Illuminate\Support\Facades\{Artisan, Auth, Route};
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Route::get('login-user-using-id/{userId}', function ($userId){
//     Auth::guard('admins')->loginUsingId($userId);
//     return redirect()->back();
// })->name('login.usingId');


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']

    ],
    function () {

        Route::group(['prefix' => 'dashboard'], function () {

            Route::controller(AuthController::class)->group(function () {
                Route::get('login', 'loginForm')->name('login');
                Route::post('login', 'login')->name('postLogin');

                Route::get('reset-password', 'getResetPassword')->name('getResetPassword');
                Route::post('reset-password', 'postResetPassword')->name('postResetPassword');
                Route::get('check-reset-password', 'checkResetCode');
                Route::post('change-password', 'changePassword')->name('changePassword');
            });

            Route::middleware(['auth:admins'])->group(function () {
                Route::controller(AuthController::class)->group(function () {
                    Route::get('logout', 'logout')->name('logout');
                });

                Route::controller(DashboardController::class)->group(function () {
                    Route::get('/index', 'index')->name('index');
                    Route::get('/dashboard', 'dashboard')->name('dashboard');
                });

                Route::controller(AdminController::class)->prefix('admins')->name('admins.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/{id}/edit', 'edit')->name('edit');
                    Route::put('/{id}/update', 'update')->name('update');
                    Route::delete('/{id}/', 'destroy')->name('delete');
                });

                Route::controller(RoleController::class)->prefix('roles')->name('roles.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/{id}/', 'show')->name('show');
                    Route::put('/{id}/', 'update')->name('update');
                    /** ajax routes **/
                    Route::get('role/{id}/admins', 'admins');
                });

                Route::controller(UserController::class)->prefix('users')->name('users.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/{id}/edit', 'edit')->name('edit');
                    Route::put('/{id}/update', 'update')->name('update');
                    Route::delete('/{id}/', 'destroy')->name('delete');
                });

                Route::controller(SettingController::class)->prefix('settings')->name('settings.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::put('/update', 'update')->name('update');
                });
            });
        });
    }
);
