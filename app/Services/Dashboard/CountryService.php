<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\CountryRepository;

class CountryService
{
    protected $countryRepository;
    //__construct
    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    // get country
    public function getCountry($id)
    {
        $country = $this->countryRepository->getCountry($id);
        if (!$country) {
            return false;
        }
        return $country;
    }

    // get countries
    public function getCountries()
    {
        return $this->countryRepository->getCountries();
    }

    // get active countries
    public function getActiveCountries()
    {
        return $this->countryRepository->getActiveCountries();
    }

    // get all countries without relations
    public function getAllCountriesWithoutRelations()
    {
        return $this->countryRepository->getAllCountriesWithoutRelations();
    }

    // get all governorates by country
    public function getAllGovernoratiesByCountry($id)
    {
        $country = self::getCountry($id);
        $governorates = $this->countryRepository->getAllGovernoratiesByCountry($country);
        return $governorates;
    }

    // store country
    public function storeCountry($data)
    {
        $country = $this->countryRepository->storeCountry($data);
        if (!$country) {
            return false;
        }
        return $country;
    }
    // update country
    public function updateCountry($data, $id)
    {
        $country = self::getCountry($id);
        if (!$country) {
            return false;
        }

        $country = $this->countryRepository->updateCountry($data, $country);
        if (!$country) {
            return false;
        }
        return $country;
    }

    // destory country
    public function destroyCountry($id)
    {
        $country = self::getCountry($id);
        // if (!$country) {
        //     return 'notFound';
        // }
        // if ($country->governorates->count() > 0) {
        //     return 'hasGovernorate';
        // }

        if ($country->governorates->count() > 0 || $country->fromFlightTicket->count() > 0  || $country->toFlightTicket->count() > 0 || !$country) {
            return false;
        }

        $country = $this->countryRepository->destroyCountry($country);
        if (!$country) {
            return false;
        }
        return $country;
    }

    // change status
    public function changeStatus($id, $status)
    {
        $country = self::getCountry($id);
        if (!$country) {
            return false;
        }
        $country = $this->countryRepository->changeStatus($country, $status);
        if (!$country) {
            return false;
        }
        return $country;
    }
}
