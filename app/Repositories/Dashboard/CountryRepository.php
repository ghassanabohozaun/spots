<?php

namespace App\Repositories\Dashboard;

use App\Models\Country;
use PhpParser\Node\Expr\FuncCall;

class CountryRepository
{
    // get country
    public function getCountry($id)
    {
        return Country::find($id);
    }

    // get countries
    public function getCountries()
    {
        return Country::withCount(['cities'])
            ->when(!empty(request()->keyword), function ($query) {
                $query->where('name', 'like', '%' . request()->keyword . '%');
            })
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    // get active countries
    public function getActiveCountries()
    {
        return Country::withCount(['cities'])
            ->orderByDesc('created_at')
            ->active()
            ->get();
    }

    // get all countries without relations
    public function getAllCountriesWithoutRelations()
    {
        return Country::get();
    }

    // get all cities by country
    public function getAllCitiesByCountry($country)
    {
        return $country->cities()->get();
    }

    // store country
    public function storeCountry($data)
    {
        return Country::create($data);
    }

    // update country
    public function updateCountry($data, $country)
    {
        return $country->update($data);
    }

    // destory country
    public function destroyCountry($country)
    {
        $country = $country->forceDelete();
        return $country;
    }

    // change status
    public function changeStatus($country, $status)
    {
        $country = $country->update([
            'status' => $status,
        ]);
        return $country;
    }


    // autocomplete country
    public function autocompleteCountry($searchValue)
    {
        return Country::select('name->en as country_en', 'name->ar as country_ar', 'id')
            ->where('name->en', 'LIKE', '%' . $searchValue . '%')
            ->orWhere('name->ar', 'LIKE', '%' . $searchValue . '%')
            ->active()
            ->get();
    }
}
