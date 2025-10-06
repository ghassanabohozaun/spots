<?php

use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\Auth\Passowrd\ForgetPasswordController;
use App\Http\Controllers\Dashboard\Auth\Passowrd\ResetPasswordController;
use App\Http\Controllers\Dashboard\{AdminsController,CountriesController, SlidersController,UsersController, CitiesController, DashboardController, GovernoratiesController, ProductsController, RolesController, SettingsController};
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/dashboard',
        'as' => 'dashboard.',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {
        ########################################### Auth  ##################################################################
        Route::get('login', [AuthController::class, 'getLogin'])->name('get.login');
        Route::post('login', [AuthController::class, 'postLogin'])->name('post.login');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        ########################################### reset password  ######################################################################
        Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
            Route::controller(ForgetPasswordController::class)->group(function () {
                Route::get('email', 'showEmailForm')->name('get.email');
                Route::post('email', 'sendOTP')->name('post.email');
                Route::get('verify/{email?}', 'showVerifyOTPForm')->name('verify');
                Route::post('verify', 'verifyOTP')->name('post.verify');
            });

            Route::controller(ResetPasswordController::class)->group(function () {
                Route::get('reset/{email?}', 'showResetFrom')->name('reset');
                Route::post('reset', 'resetPasword')->name('post.reset');
            });
        });

        ########################################### protected routes  #####################################################################
        Route::group(['middleware' => 'auth:admin'], function () {
            ########################################### welcome  ##########################################################################
            Route::get('/', [DashboardController::class, 'index'])->name('index');
            ########################################### settings routes  ##################################################################
            Route::group(['middleware' => 'can:settings'], function () {
                Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
                Route::put('/settings/{id?}', [SettingsController::class, 'update'])->name('settings.update');
            });
            ###########################################  sliders routes  ##################################################################
            Route::group(['middlwire' => 'can:sliders'], function () {
                Route::resource('sliders', SlidersController::class);
                Route::get('/slides-all', [SlidersController::class, 'getAll'])->name('sliders.get.all');
                Route::post('/sliders/change-status', [SlidersController::class, 'changeStatus'])->name('sliders.change.status');
            });

            ########################################### roles routes #######################################################################
            Route::group(['middleware' => 'can:roles'], function () {
                Route::resource('roles', RolesController::class);
                Route::post('/roles/destroy', [RolesController::class, 'destroy'])->name('roles.destroy');
            });

            ########################################### admins routes  #####################################################################
            Route::group(['middleware' => 'can:admins'], function () {
                Route::resource('admins', AdminsController::class);
                Route::post('/admins/destroy', [AdminsController::class, 'destroy'])->name('admins.destroy');
                Route::post('/admins/status', [AdminsController::class, 'changeStatus'])->name('admins.change.status');
            });

            ########################################### users routes  ######################################################################
            Route::group(['middlewire' => 'can:users'], function () {
                Route::resource('users', UsersController::class);
                Route::get('/users-all', [UsersController::class, 'getAll'])->name('users.get.all');
                Route::post('/users/change-status', [UsersController::class, 'changeStatus'])->name('users.change.status');
            });
            ########################################### world routes  ######################################################################
            Route::group(['middleware' => 'can:world'], function () {
                // countries routes
                Route::resource('countries', CountriesController::class);
                Route::post('/countries/destroy', [CountriesController::class, 'destroy'])->name('countries.destroy');
                Route::post('/countries/status', [CountriesController::class, 'changeStatus'])->name('countries.change.status');
                Route::get('/country/{country_id?}/governorates', [CountriesController::class, 'getGovrnoratesByCountryID'])->name('countries.get.govnernorates.by.country.id');
                // governorates routes
                Route::resource('governorates', GovernoratiesController::class);
                Route::post('/governorates/destroy', [GovernoratiesController::class, 'destroy'])->name('governorates.destroy');
                Route::get('/governorates/status/{id?}', [GovernoratiesController::class, 'changeStatus'])->name('governorates.change.status');
                Route::get('/governorates/get/all/cities', [GovernoratiesController::class, 'getAllCitiesByGovernorate'])->name('governorates.get.all.cities');
                Route::get('/governorate/{governorate_id?}/cities', [GovernoratiesController::class, 'getCitesByGovernrateID'])->name('governorates.get.cities.by.governorate.id');
                Route::post('/govnerorates/update/price', [GovernoratiesController::class, 'updateShippingPrice'])->name('governorates.update.shipping.price');

                // cities routes
                Route::resource('cities', CitiesController::class);
                Route::post('/cities/destroy', [CitiesController::class, 'destroy'])->name('cities.destroy');
            });
        });
    },
);
