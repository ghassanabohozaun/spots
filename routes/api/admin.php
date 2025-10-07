<?php

use App\Http\Controllers\Api\Admin\AddressController;
use App\Http\Controllers\Api\Admin\Auth\LoginController;
use App\Http\Controllers\Api\Admin\Auth\RegisterController;
use Illuminate\Support\Facades\Route;


// Route::group(['middleware' => 'setLanguage'], function () {
########################################### login routes  ##############################################################
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:admin-api');

########################################### register routes  ##############################################################
// Route::post('register', [RegisterController::class, 'register']);

########################################### address routes  ##############################################################
Route::controller(AddressController::class)->group(function () {
    Route::get('get-countries', 'getCountries');
    Route::get('get-governorates/{country_id}', 'getGovernorates');
    Route::get('get-cities/{governorate_id}', 'getCities');
});
########################################### auth admin api routes ##################################################################
Route::group(['middleware' => 'auth:admin-api'], function () {
    Route::get('testAuth', function () {
        return 'authicated';
    });
});
// });
