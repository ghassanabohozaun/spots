<?php

use App\Models\Admin;
use App\Models\AttributeValue;
use App\Models\City;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\Setting;
use Illuminate\Support\Facades\Config;

//  setting Helper Function
if (!function_exists('setting')) {
    function setting()
    {
        return Setting::orderBy('id', 'desc')->first();
    }
}

//  get language Helper Function
if (!function_exists('Lang')) {
    function Lang()
    {
        return app()->getLocale();
    }
}

//  get admin Helper Function
if (!function_exists('admin')) {
    function admin()
    {
        return auth()->guard('admin');
    }
}

//  get web Helper Function
if (!function_exists('web')) {
    function web()
    {
        return auth()->guard('web');
    }
}

if (!function_exists('slug')) {
    function slug($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $stringToLower = strtolower($string);
        return preg_replace('/[^\w\s\-]+/u', '', $stringToLower);
    }
}

if (!function_exists('replaceHyphensWithSpaces')) {
    function replaceHyphensWithSpaces($string)
    {
        return $string = str_replace('-', ' ', $string); // Replaces all hyphens with spaces.
    }

    //  get admin count Helper Function
    if (!function_exists('adminCount')) {
        function adminCount()
        {
            return Admin::count();
        }
    }

    //  get country count Helper Function
    if (!function_exists('countryCount')) {
        function countryCount()
        {
            return Country::count();
        }
    }
    //  get governorate count Helper Function
    if (!function_exists('governorateCount')) {
        function governorateCount()
        {
            return Governorate::count();
        }
    }

    //  get city count Helper Function
    if (!function_exists('cityCount')) {
        function cityCount()
        {
            return City::count();
        }
    }
}
