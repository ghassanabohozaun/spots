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
        $conuntries = Country::withCount(['governorates', 'users'])
            ->when(!empty(request()->keyword), function ($query) {
                $query->where('name', 'like', '%' . request()->keyword . '%');
            })
            ->orderByDesc('id')
            ->paginate(10);
        return $conuntries;
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
    public function storeCountry($request)
    {
        $country = Country::create([
            'name' => [
                'en' => $request->name['en'],
                'ar' => $request->name['ar'],
            ],
            'status' => $request->has('status') ? 1 : 0,
            'phone_code' => $request->phone_code,
            'flag_code' => $request->flag_code,
        ]);
        return $country;
    }

    // update country
    public function updateCountry($request, $id)
    {
        $country = self::getCountry($id);
        $country = $country->update([
            'name' => [
                'en' => $request->name['en'],
                'ar' => $request->name['ar'],
            ],
            'status' => $request->has('status') ? 1 : 0,
            'phone_code' => $request->phone_code,
            'flag_code' => $request->flag_code,
        ]);

        return $country;
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
