<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\CountryRespurce;
use App\Http\Resources\GovernorateResource;
use App\Services\Api\AddressService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    use ApiResponse;
    protected $addressService;
    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    // get countries
    public function getCountries()
    {
        $countries = $this->addressService->getCountries();
        return $this->ApiResponse(['countries' => CountryRespurce::collection($countries)],true, __('general.data_fetch_successfully'), 200);
    }

    // get governorates
    public function getGovernorates($country_id)
    {
        $governorates = $this->addressService->getGovernorates($country_id);
        return $this->ApiResponse(['governorates' => GovernorateResource::collection($governorates)], true,__('general.data_fetch_successfully'), 200);
    }

    //get cities
    public function getCities($governorate_id)
    {
        $cities = $this->addressService->getCities($governorate_id);
        return $this->ApiResponse(['cities' => CityResource::collection($cities)], true,__('general.data_fetch_successfully'), 200);
    }
}
