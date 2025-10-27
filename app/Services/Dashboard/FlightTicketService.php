<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\FlightTicketRepository;
use App\Utils\ImageManagerUtils;
use Yajra\DataTables\Facades\DataTables;

class FlightTicketService
{
    protected $flightTicketRepository, $imageManagerUtils;
    // __construct
    public function __construct(FlightTicketRepository $flightTicketRepository, ImageManagerUtils $imageManagerUtils)
    {
        $this->flightTicketRepository = $flightTicketRepository;
        $this->imageManagerUtils = $imageManagerUtils;
    }

    // get one
    public function getOne($id)
    {
        $ticket = $this->flightTicketRepository->getOne($id);
        if (!$ticket) {
            return false;
        }
        return $ticket;
    }

    // get all
    // public function getAll()
    // {
    //     return $this->flightTicketRepository->getAll();
    // }

    // get active
    public function getActive()
    {
        return $this->flightTicketRepository->getActive();
    }

    // get all
    public function getAll($request)
    {
        $tickets = $this->flightTicketRepository->getAll($request);

        return DataTables::of($tickets)
            ->addIndexColumn()
            ->addColumn('photo', function ($ticket) {
                return view('dashboard.tickets.parts.photo', compact('ticket'));
            })
            ->addColumn('title', function ($ticket) {
                return $ticket->getTranslation('title', Lang());
            })
            ->addColumn('details', function ($ticket) {
                return $ticket->getTranslation('details', Lang());
            })
            ->addColumn('from_country_id', function ($ticket) {
                return $ticket->formCountry->name;
            })
            ->addColumn('from_city_id', function ($ticket) {
                return $ticket->formCity->name;
            })
            ->addColumn('to_country_id', function ($ticket) {
                return $ticket->toCountry->name;
            })
            ->addColumn('to_city_id', function ($ticket) {
                return $ticket->toCity->name;
            })
            ->addColumn('created_at', function ($ticket) {
                return $ticket->created_at;
            })
            ->addColumn('status', function ($ticket) {
                return view('dashboard.tickets.parts.status', compact('ticket'));
            })
            ->addColumn('manage_status', function ($ticket) {
                return view('dashboard.tickets.parts.manage-status', compact('ticket'));
            })
            ->addColumn('actions', function ($ticket) {
                return view('dashboard.tickets.parts.actions', compact('ticket'));
            })
            ->make(true);
    }

    // store ticket
    public function store($data)
    {
        if (array_key_exists('photo', $data) && $data['photo'] != null) {
            $photo_name = $this->imageManagerUtils->saveResizeImage($data['photo'], 'tickets', 1000, 1000);
            $data['photo'] = $photo_name;
        }

        $ticket = $this->flightTicketRepository->store($data);
        if (!$ticket) {
            return false;
        }
        return $ticket;
    }

    //update ticket
    public function update($data)
    {
        $ticket = self::getOne($data['id']);
        if (!$ticket) {
            return false;
        }

        if (array_key_exists('photo', $data) && $data['photo'] != null) {
            $this->imageManagerUtils->removeImageFromLocal($ticket->photo, 'tickets');
            $photo_name = $this->imageManagerUtils->saveResizeImage($data['photo'], 'tickets', 1000, 1000);
            $data['photo'] = $photo_name;
        }

        $ticket = $this->flightTicketRepository->update($ticket, $data);
        if (!$ticket) {
            return false;
        }
        return $ticket;
    }

    // destroy ticket
    public function destroy($id)
    {
        $ticket = self::getOne($id);
        if (!$ticket) {
            return false;
        }
        if (!empty($ticket->photo)) {
            $this->imageManagerUtils->removeImageFromLocal($ticket->photo, 'tickets');
        }

        $ticket = $this->flightTicketRepository->destroy($ticket);
        if (!$ticket) {
            return false;
        }
        return $ticket;
    }

    // change status
    public function changeStatus($id, $status)
    {
        $ticket = self::getOne($id);
        if (!$ticket) {
            return false;
        }
        $ticket = $this->flightTicketRepository->changeStatus($ticket, $status);
        if (!$ticket) {
            return false;
        }
        return $ticket;
    }
}
