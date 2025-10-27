<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\FlightTicket;
use App\Models\Tour;
use App\Services\Dashboard\ChildService;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Ticket;

class DashboardController extends Controller
{
    public function __construct() {}
    public function index()
    {
        $title = __('dashboard.dashboard');
        $latestFlights = Flight::latest()->take(10)->get();
        $latestTickets = FlightTicket::latest()->take(5)->get();
        $latesTours = Tour::latest()->take(5)->get();

        return view('dashboard.index', compact('title', 'latestFlights','latestTickets','latesTours'));
    }
}
