<?php

namespace App\Repositories\Dashboard;

use App\Models\Flight;
use App\Models\FlightImage;
use App\Models\FlightIncluding;
use App\Models\FlightNote;
use App\Models\FlightNotIncluding;
use App\Models\FlightPrice;
use App\Models\FlightService;

class FlightRepository
{
    // get one flight
    public function getFlight($id)
    {
        return Flight::find($id);
    }

    // get all flights with relation egar loading
    public function getFlightsWithRelations($id)
    {
        return Flight::with(['flightServices', 'flightPrices', 'images', 'flightNotes', 'flightIncludings', 'flightNotIncludings'])->find($id);
    }

    // get flights
    public function getFlights($request)
    {
        //dd( Flight::with(['country', 'city', 'category'])->get());

        return Flight::with(['country', 'city', 'category'])
            ->when(!empty(request()->flight_name), function ($query) {
                $query->where('name', 'like', '%' . request()->flight_name . '%');
            })
            ->when(!empty(request()->country_id), function ($query) {
                $query->where('country_id', request()->country_id);
            })
            ->when(!empty(request()->city_id), function ($query) {
                $query->where('city_id', request()->city_id);
            })
            ->when(!empty(request()->category_id), function ($query) {
                $query->where('category_id', request()->category_id);
            })
            ->when(request()->status != null, function ($query) {
                $query->where('status', request()->status);
            })
            ->latest()
            ->get();
    }

    // create flight
    public function createFlight($data)
    {
        return Flight::create($data);
    }

    // update flight
    public function updateFlight($flight, $data)
    {
        return $flight->update($data);
    }

    // destroy flight
    public function destroyFlight($flight)
    {
        return $flight->forceDelete();
    }

    // change status
    public function changeStatus($flight, $status)
    {
        return $flight->update([
            'status' => $status,
        ]);
    }

    //////////////////////////////////////////////////////////////////////////////////////
    // services
    // get flight service
    public function getFlightService($id)
    {
        return FlightService::find($id);
    }

    // create flight service
    public function createFlightService($service)
    {
        return FlightService::create($service);
    }

    // delete one flight service
    public function deleteOneFlightService($service)
    {
        return $service->forceDelete();
    }

    // delete all flight services
    public function deleteAllFlightServices($flight)
    {
        return $flight->flightServices()->forceDelete();
    }

    //////////////////////////////////////////////////////////////////////////////////////
    // prices
    // get flight price
    public function getFlightPrice($id)
    {
        return FlightPrice::find($id);
    }

    // create flight price
    public function createFlightPrice($price)
    {
        return FlightPrice::create($price);
    }

    // delete one flight price
    public function deleteOneFlightPrice($price)
    {
        return $price->forceDelete();
    }

    // delete all flight prices
    public function deleteAllFlightPrices($flight)
    {
        return $flight->flightPrices()->forceDelete();
    }

    //////////////////////////////////////////////////////////////////////////////////////
    // notes
    // get flight note
    public function getFlightNote($id)
    {
        return FlightNote::find($id);
    }

    // create flight note
    public function createFlightNote($note)
    {
        return FlightNote::create($note);
    }

    // delete one flight note
    public function deleteOneFlightNote($note)
    {
        return $note->forceDelete();
    }

    // delete all flight notes
    public function deleteAllFlightNotes($flight)
    {
        return $flight->flightNotes()->forceDelete();
    }

    //////////////////////////////////////////////////////////////////////////////////////
    // offer including
    // get flight offer including
    public function getFlightIncluding($id)
    {
        return FlightIncluding::find($id);
    }

    // create flight offer including
    public function createFlightIncluding($offerIncluding)
    {
        return FlightIncluding::create($offerIncluding);
    }

    // delete one flight offer including
    public function deleteOneFlighIncluding($offerIncluding)
    {
        return $offerIncluding->forceDelete();
    }

    // delete all flight offer including
    public function deleteAllFlightIncluding($flight)
    {
        return $flight->flightIncludings()->forceDelete();
    }

    //////////////////////////////////////////////////////////////////////////////////////
    // offer not including
    // get flight offer not including
    public function getFlightNotIncluding($id)
    {
        return FlightNotIncluding::find($id);
    }

    // create flight offer including
    public function createFlightNotIncluding($offerNotIncluding)
    {
        return FlightNotIncluding::create($offerNotIncluding);
    }

    // delete one flight offer including
    public function deleteOneFlighNotIncluding($offerNotIncluding)
    {
        return $offerNotIncluding->forceDelete();
    }

    // delete all flight offer including
    public function deleteAllFlightNotIncluding($flight)
    {
        return $flight->flightNotIncludings()->forceDelete();
    }

    //////////////////////////////////////////////////////////////////////////////////////
    // flight images

    // get flight image
    public function getFlightImage($id)
    {
        return FlightImage::find($id);
    }

    // get Flight Images
    public function getFlightImages($flight)
    {
        return $flight->images()->get();
    }

    // delete flight image
    public function deleteFlightImage($imageId)
    {
        return FlightImage::where('id', $imageId)->forceDelete();
    }
    // delete all fight images
    public function deleteAllFlightImages($flight)
    {
        return $flight->images()->forceDelete();
    }
}
