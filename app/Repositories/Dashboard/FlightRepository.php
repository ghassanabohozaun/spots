<?php

namespace App\Repositories\Dashboard;

use App\Models\Flight;

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
        return Flight::with(['flightServices', 'flightPrices', 'flightImages', 'flightNotes', 'flightIncludeings', 'flightNotIncludeings'])->find($id);
    }

    // get flights
    public function getFlights($request)
    {
        return Flight::with(['country', 'governorate', 'category'])
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
}
