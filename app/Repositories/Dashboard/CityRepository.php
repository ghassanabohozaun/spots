<?php

namespace App\Repositories\Dashboard;

use App\Models\City;
use App\Models\Governorate;

class CityRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    // get city
    public function getCity($id)
    {
        return City::find($id);
    }

    // get cities
    public function getCities()
    {
        $cities = City::when(!empty(request()->keyword), function ($query) {
            $query->where('name', 'like', '%' . request()->keyword . '%');
        })
            ->orderByDesc('id')
            ->select('id', 'name', 'governorate_id')
            ->paginate(10);
        return $cities;
    }

    // get cities without Relations
    public function getAllCitiesWithoutRelation()
    {
        return City::get();
    }

    // store city
    public function storeCity($data)
    {
        return City::create($data);
    }

    // update city
    public function updateCity($data, $city)
    {
        return $city->update($data);
    }

    // destroy city
    public function destroyCity($city)
    {
        return $city->forceDelete();
    }
    // change status
    public function changeStatus($city, $status)
    {
        $city = $city->update([
            'status' => $status,
        ]);
        return $city;
    }

    // autocomplete
    public function autocompleteGovnerorate($searchValue)
    {
        return Governorate::select('name->en as country_en', 'name->ar as country_ar', 'id')
            ->where('name->en', 'LIKE', '%' . $searchValue . '%')
            ->orWhere('name->ar', 'LIKE', '%' . $searchValue . '%')
            ->active()
            ->get();
    }
}
