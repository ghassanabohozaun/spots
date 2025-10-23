<?php

namespace App\Services\Dashboard;

use App\Models\ShippingGovernorate;
use App\Repositories\Dashboard\GovernorateRepository;

class GovernorateService
{
    protected $governorateRepository;
    //__construct
    public function __construct(GovernorateRepository $governorateRepository)
    {
        $this->governorateRepository = $governorateRepository;
    }

    // get governorate
    public function getGovernorate($id)
    {
        $governorate = $this->governorateRepository->getGovernorate($id);
        if (!$governorate) {
            return false;
        }
        return $governorate;
    }

    // get governoraties
    public function getGovernoraties()
    {
        return $this->governorateRepository->getgovernoraties();
    }

   // get governoraties
    public function getActiveGovernoraties()
    {
        return $this->governorateRepository->getActiveGovernoraties();
    }
    // get all governorates without relations
    public function getAllGovernoratesWithoutRelations()
    {
        return $this->governorateRepository->getAllGovernoratesWithoutRelations();
    }

    // get all cities by governorate
    public function getAllCitiesbyGovernorate($id)
    {
        $governorate = self::getGovernorate($id);
        $cities = $this->governorateRepository->getAllCitiesbyGovernorate($governorate);
        return $cities;
    }
    // store governorate
    public function storeGovernorate($data)
    {
        $governorate = $this->governorateRepository->storeGovernorate($data);
        if (!$governorate) {
            return false;
        }
        return $governorate;
    }

    // update governorate
    public function updateGovernorate($data, $id)
    {
        $governorate = self::getGovernorate($id);
        if (!$governorate) {
            return false;
        }
        $governorate = $this->governorateRepository->updateGovernorate($data, $governorate);
        if (!$governorate) {
            return false;
        }
        return $governorate;
    }

    // change status
    public function changeStatus($id)
    {
        $governorate = self::getGovernorate($id);
        if (!$governorate) {
            return false;
        }
        $governorate = $this->governorateRepository->changeStatus($governorate);
        if (!$governorate) {
            return false;
        }
        return $governorate;
    }

    // autocomplete
    public function autocompleteCountry($searchValue)
    {
        return $this->governorateRepository->autocompleteCountry($searchValue);
    }

    // destory governorate
    public function destroyGovernorate($id)
    {
        $governorate = self::getGovernorate($id);
        if ($governorate->cities->count() > 0 || $governorate->fromFlightTicket->count() > 0  || $governorate->toFlightTicket->count() > 0 || !$governorate) {
            return false;
        }

        $governorate = $this->governorateRepository->destroyGovernorate($governorate);
        if (!$governorate) {
            return false;
        }
        return $governorate;
    }
}
