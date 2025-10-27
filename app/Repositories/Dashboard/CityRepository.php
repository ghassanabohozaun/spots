<?php

namespace App\Repositories\Dashboard;

use App\Models\City;
use App\Models\Country;

class CityRepository
{
    // get City
    public function getCity($id)
    {
        return City::find($id);
    }

    // get cities
    public function getCities()
    {
        return City::when(!empty(request()->keyword), function ($q) {
            $q->where('name', 'like', '%' . request()->keyword . '%');
        })
            ->orderByDesc('id')
            ->paginate(10);
    }

    // get active cities
    public function getActiveCities()
    {
        return City::orderByDesc('created_at')->get();
    }

    // get all cities without relations
    public function getAllCitiesWithoutRelations()
    {
        return City::get();
    }

    // get all cities by country
    public function getAllCitiesbyCountry($country)
    {
        $cities = $country->cities()->get();
        return $cities;
    }

    // store City
    public function storeCity($data)
    {
        return City::create($data);
    }

    // update City
    public function updateCity($data, $City)
    {
        return $City->update($data);
    }

    // change status
    public function changeStatus($City)
    {
        $City = $City->update([
            'status' => $City->status == 'on' ? 0 : 1,
        ]);
        return $City;
    }

    // destory City
    public function destroyCity($City)
    {
        $City = $City->forceDelete();
        return $City;
    }

    // autocomplete city
    public function autocompleteCity($searchValue)
    {
        return City::select('name->en as city_en', 'name->ar as city_ar', 'id')
            ->where('name->en', 'LIKE', '%' . $searchValue . '%')
            ->orWhere('name->ar', 'LIKE', '%' . $searchValue . '%')
            ->active()
            ->get();
    }
}
