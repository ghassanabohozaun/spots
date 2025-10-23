<?php

namespace App\Repositories\Dashboard;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\ShippingGovernorate;

class GovernorateRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    // get governorate
    public function getGovernorate($id)
    {
        return Governorate::find($id);
    }

    // get governorates
    public function getgovernoraties()
    {
        return Governorate::withCount(['cities'])
            ->when(!empty(request()->keyword), function ($q) {
                $q->where('name', 'like', '%' . request()->keyword . '%');
            })
            ->orderByDesc('id')
            ->paginate(10);
    }

    // get governorates
    public function getActiveGovernoraties()
    {
        return Governorate::withCount(['cities'])
            ->orderByDesc('created_at')
            ->get();
    }

    // get all governorates without relations
    public function getAllGovernoratesWithoutRelations()
    {
        return Governorate::get();
    }

    // get all cities by governorate
    public function getAllCitiesbyGovernorate($governorate)
    {
        $cities = $governorate->cities()->get();
        return $cities;
    }

    // store governorate
    public function storeGovernorate($data)
    {
        $governorate = Governorate::create($data);
        return $governorate;
    }

    // update governorate
    public function updateGovernorate($data, $governorate)
    {
        return $governorate->update($data);
    }

    // change status
    public function changeStatus($governorate)
    {
        $governorate = $governorate->update([
            'status' => $governorate->status == 'on' ? 0 : 1,
        ]);
        return $governorate;
    }

    // autocomplete
    public function autocompleteCountry($searchValue)
    {
        return Country::select('name->en as country_en', 'name->ar as country_ar', 'id')
            ->where('name->en', 'LIKE', '%' . $searchValue . '%')
            ->orWhere('name->ar', 'LIKE', '%' . $searchValue . '%')
            ->active()
            ->get();
    }

    // destory governorate
    public function destroyGovernorate($governorate)
    {
        $governorate = $governorate->forceDelete();
        return $governorate;
    }
}
