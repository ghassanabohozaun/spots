<?php

use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\Auth\Passowrd\ForgetPasswordController;
use App\Http\Controllers\Dashboard\Auth\Passowrd\ResetPasswordController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\{AdminsController, CountriesController, SlidersController, PagesController, UsersController, CitiesController, DashboardController, FlightsController, FlightTicketsController, MailingBoxController, RolesController, SettingsController, ToursController};
use App\Http\Controllers\Dashboard\NotificationsController;
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
            Route::get('/welcome', [DashboardController::class, 'index'])->name('index');
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
            ###########################################  pages routes  ######################################################################
            Route::group(['middlewire' => 'can:pages'], function () {
                Route::resource('pages', PagesController::class);
                Route::get('/pages-all', [PagesController::class, 'getAll'])->name('pages.get.all');
                Route::post('/pages/change-status', [PagesController::class, 'changeStatus'])->name('pages.change.status');
                Route::post('/pages/delete-photo', [PagesController::class, 'deletePhoto'])->name('pages.delete.photo');
            });

            ########################################### roles routes #######################################################################
            Route::group(['middleware' => 'can:roles'], function () {
                Route::resource('roles', RolesController::class);
                Route::post('/roles/destroy', [RolesController::class, 'destroy'])->name('roles.destroy');
            });

            ########################################### admins routes  #####################################################################
            Route::group(['middleware' => 'can:admins'], function () {
                Route::get('/admins/export', [AdminsController::class, 'export'])->name('admins.export');
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
                Route::get('/country/{country_id?}/cities', [CountriesController::class, 'getAllCitiesByCountry'])->name('countries.get.cities.by.country.id');
                Route::get('/countries/autocomplete/country', [CountriesController::class, 'autocompleteCountry'])->name('countries.autocomplete.country');

                // cities routes
                Route::resource('cities', CitiesController::class);
                Route::post('/cities/destroy', [CitiesController::class, 'destroy'])->name('cities.destroy');
                Route::get('/cities/status/{id?}', [CitiesController::class, 'changeStatus'])->name('cities.change.status');
                Route::get('/cities/get/all/cities', [CitiesController::class, 'getAllCitiesByGovernorate'])->name('cities.get.all.cities');
                Route::get('/cities/autocomplete/city', [CitiesController::class, 'autocompleteCity'])->name('cities.autocomplete.city');
            });

            ########################################### tickets  ######################################################################
            Route::group(['middleware' => 'can:tickets'], function () {
                Route::get('/tickets/export', [FlightTicketsController::class, 'export'])->name('tickets.export');
                Route::resource('tickets', FlightTicketsController::class);
                Route::get('/tickets-all', [FlightTicketsController::class, 'getAll'])->name('tickets.get.all');
                Route::post('/tickets/change-status', [FlightTicketsController::class, 'changeStatus'])->name('tickets.change.status');
            });

            ########################################### tours  ######################################################################
            Route::group(['middleware' => 'can:tours'], function () {
                Route::get('/tours/export', [ToursController::class, 'export'])->name('tours.export');
                Route::resource('tours', ToursController::class);
                Route::get('/tours-all', [ToursController::class, 'getAll'])->name('tours.get.all');
                Route::post('/tours/change-status', [ToursController::class, 'changeStatus'])->name('tours.change.status');
            });

            ########################################### flights  ######################################################################
            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/livewire/update', $handle);
            });

            Route::group(['middleware' => 'can:flights'], function () {
                Route::resource('flights', FlightsController::class);
                Route::get('/flights-all', [FlightsController::class, 'getAll'])->name('flights.get.all');
                Route::post('/flights/change-status', [FlightsController::class, 'changeStatus'])->name('flights.change.status');
                Route::get('/children/get-cities/{id?}', [FlightsController::class, 'getCities'])->name('flights.get.cities');
            });

            ########################################### categories routes  ##################################################################################
            Route::group(['middleware' => 'can:categories'], function () {
                Route::resource('categories', CategoriesController::class)->except('show');
                Route::get('/categories-all', [CategoriesController::class, 'getAll'])->name('categories.all');
                Route::post('/categories/destroy', [CategoriesController::class, 'destroy'])->name('categories.destroy');
                Route::post('/categories/status', [CategoriesController::class, 'changeStatus'])->name('categories.change.status');
                Route::get('/categories/getFlights/{category_id?}', [CategoriesController::class, 'getFlights'])->name('categories.get.flights');
                Route::get('categories/flight-paginate', [CategoriesController::class, 'flightPaging'])->name('categories.flights.paging');
            });
            ########################################### brands routes  ####################################################################################

            ###########################################  mailing routes  ##################################################################
            Route::group(['middlwire' => 'can:mailing'], function () {
                Route::resource('mailing', MailingBoxController::class);
                Route::post('/mailing/change-status', [MailingBoxController::class, 'changeStatus'])->name('mailing.change.status');

            });

            ###########################################  notifications routes  ##################################################################
            Route::group(['middlwire' => 'can:notifications'], function () {
                Route::resource('notifications', NotificationsController::class);
                Route::post('/notifications/change-status', [NotificationsController::class, 'changeStatus'])->name('notifications.change.status');

            });
        });
    },
);
