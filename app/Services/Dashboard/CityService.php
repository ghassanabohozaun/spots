<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\CityRepository;

class CityService
{
    protected $cityRepository;
    //__construct
    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    // get city
    public function getCity($id)
    {
        $city = $this->cityRepository->getCity($id);
        if (!$city) {
            return false;
        }
        return $city;
    }

    // get cities
    public function getCities()
    {
        return $this->cityRepository->getCities();
    }

   // get active cities
    public function getActiveCities()
    {
        return $this->cityRepository->getActiveCities();
    }
    // get all cities without relations
    public function getAllCitiesWithoutRelations()
    {
        return $this->cityRepository->getAllCitiesWithoutRelations();
    }


    // store city
    public function storeCity($data)
    {
        $city = $this->cityRepository->storeCity($data);
        if (!$city) {
            return false;
        }
        return $city;
    }

    // update city
    public function updateCity($data, $id)
    {
        $city = self::getCity($id);
        if (!$city) {
            return false;
        }
        $city = $this->cityRepository->updateCity($data, $city);
        if (!$city) {
            return false;
        }
        return $city;
    }

    // change status
    public function changeStatus($id)
    {
        $city = self::getCity($id);
        if (!$city) {
            return false;
        }
        $city = $this->cityRepository->changeStatus($city);
        if (!$city) {
            return false;
        }
        return $city;
    }


    // destory city
    public function destroyCity($id)
    {
        $city = self::getCity($id);
        if ($city->fromFlightTicket->count() > 0  || $city->toFlightTicket->count() > 0 || $city->tours->count() > 0   || $city->flights->count() > 0  || !$city) {
            return false;
        }

        $city = $this->cityRepository->destroyCity($city);
        if (!$city) {
            return false;
        }
        return $city;
    }

   // autocomplete
    public function autocompleteCity($searchValue)
    {
        return $this->cityRepository->autocompleteCity($searchValue);
    }

}
