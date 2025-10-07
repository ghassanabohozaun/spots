<?php

use App\Http\Controllers\Api\Web\GlobalController;
use App\Http\Controllers\Api\Web\SliderController;
use Illuminate\Support\Facades\Route;

########################################### sliders routes  ##############################################################
Route::controller(GlobalController::class)->group(function () {
    //settings
    Route::get('get-settings', 'getSettings');

    // sliders
    Route::get('get-sliders', 'getSliders');
});
