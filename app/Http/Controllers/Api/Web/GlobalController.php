<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Http\Resources\SliderResource;
use App\Services\Api\GlobalService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    use ApiResponse;

    protected $globalService;
    public function __construct(GlobalService $globalService)
    {
        $this->globalService = $globalService;
    }

    // get settings
    public function getSettings()
    {
        $settings = $this->globalService->getSettings();
        return $this->ApiResponse(['data' => new SettingResource($settings)], true, __('settings.settings'), 200);
    }
    // get sliders
    public function getSliders()
    {
        $sliders = $this->globalService->getSliders();
        return $this->ApiResponse(['data' => SliderResource::collection($sliders)], true, __('sliders.sliders'), 200);
    }
}
