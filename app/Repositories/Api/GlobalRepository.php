<?php

namespace App\Repositories\Api;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Slider;

class GlobalRepository
{
    // get settings
    public function getSettings()
    {
        return Setting::first();
    }

    // get sliders
    public function getSliders($limit = null)
    {
        if ($limit == null) {
            return Slider::active()->latest()->get();
        }
        return Slider::active()->limit($limit)->latest()->get();
    }
}
