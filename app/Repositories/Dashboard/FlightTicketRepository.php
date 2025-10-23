<?php

namespace App\Repositories\Dashboard;

use App\Models\FlightTicket;

class FlightTicketRepository
{
    // get one ticket
    public function getOne($id)
    {
        return FlightTicket::find($id);
    }

    // get all tickets
    public function getAll($request)
    {

        return FlightTicket::orderByDesc('created_at')
            ->when(!empty(request()->price), function ($query) {
                $query->where('price', request()->price);
            })
            ->when(!empty(request()->from_country_id), function ($query) {
                $query->where('from_country_id', request()->from_country_id);
            })
            ->when(!empty(request()->from_governorate_id), function ($query) {
                $query->where('from_governorate_id', request()->from_governorate_id);
            })
            ->when(!empty(request()->to_country_id), function ($query) {
                $query->where('to_country_id', request()->to_country_id);
            })
            ->when(!empty(request()->to_governorate_id), function ($query) {
                $query->where('to_governorate_id', request()->to_governorate_id);
            })
            ->when(request()->status != null, function ($query) {
                $query->where('status', request()->status);
            })
            ->select('id', 'title', 'details', 'price', 'from_country_id', 'from_governorate_id', 'to_country_id', 'to_governorate_id', 'status', 'photo', 'created_at')
            ->latest()
            ->get();
    }

    // get active tickets
    public function getActive()
    {
        return FlightTicket::orderByDesc('created_at')->active()->select('id', 'title', 'details', 'price', 'from_country_id', 'from_governorate_id', 'to_country_id', 'to_governorate_id', 'status', 'photo', 'created_at')->get();
    }

    // store ticket
    public function store($ticket)
    {
        return FlightTicket::create($ticket);
    }

    //update ticket
    public function update($ticket, $data)
    {
        return $ticket->update($data);
    }

    // destroy ticket
    public function destroy($ticket)
    {
        return $ticket->forceDelete();
    }

    // change status
    public function changeStatus($ticket, $status)
    {
        return $ticket->update([
            'status' => $status,
        ]);
    }
}
