<?php

namespace App\Repositories\Dashboard;

use App\Models\Country;
use PhpParser\Node\Expr\FuncCall;

class CountryRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    // get country
    public function getCountry($id)
    {
        return Country::find($id);
    }

    // get countries
    public function getCountries()
    {
        return Country::withCount(['governorates'])
            ->when(!empty(request()->keyword), function ($query) {
                $query->where('name', 'like', '%' . request()->keyword . '%');
            })
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    // get active countries
    public function getActiveCountries()
    {
        return Country::withCount(['governorates'])
            ->orderByDesc('created_at')
            ->active()
            ->get();
    }

    // get all countries without relations
    public function getAllCountriesWithoutRelations()
    {
        return Country::get();
    }

    // get all governorates by country
    public function getAllGovernoratiesByCountry($country)
    {
        $governorates = $country
            ->governorates()
            ->withCount(['cities', 'users'])
            ->with(['country', 'shippingPrice'])
            ->get();
        return $governorates;
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
}
