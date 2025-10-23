<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\TicketExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TicketRequest;
use App\Models\FlightTicket;
use App\Services\Dashboard\CountryService;
use App\Services\Dashboard\FlightTicketService;
use App\Services\Dashboard\GovernorateService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FlightTicketsController extends Controller
{
    protected $flightTicketService, $countryService, $governorateService;
    public function __construct(FlightTicketService $flightTicketService, CountryService $countryService, GovernorateService $governorateService)
    {
        $this->flightTicketService = $flightTicketService;
        $this->countryService = $countryService;
        $this->governorateService = $governorateService;
    }

    // index
    public function index()
    {
        $title = __('tickets.tickets');
        return view('dashboard.tickets.index', compact('title'));
    }

    public function getAll(Request $request)
    {
        return $this->flightTicketService->getAll($request);
    }

    // create
    public function create()
    {
        $title = __('tickets.create_new_ticket');
        return view('dashboard.tickets.create', compact('title'));
    }

    // store
    public function store(TicketRequest $request)
    {
        $data = $request->only(['title', 'details', 'price', 'from_country_id', 'from_governorate_id', 'to_country_id', 'to_governorate_id', 'status', 'photo']);
        $ticket = $this->flightTicketService->store($data);
        if (!$ticket) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true], 201);
    }

    // show
    public function show(string $id)
    {
        //
    }

    // edit
    public function edit(string $id)
    {
        $title = __('tickets.update_ticket');
        $ticket = $this->flightTicketService->getOne($id);
        if (!$ticket) {
            flash()->error(__('general.no_record_found'));
            return redirect()->back();
        }

        $countries = $this->countryService->getActiveCountries();
        $governorates = $this->governorateService->getActiveGovernoraties();
        return view('dashboard.tickets.edit', compact('title', 'ticket', 'countries', 'governorates'));
    }

    // update
    public function update(TicketRequest $request, string $id)
    {
        $data = $request->only(['id', 'title', 'details', 'price', 'from_country_id', 'from_governorate_id', 'to_country_id', 'to_governorate_id', 'status', 'photo']);
        $ticket = $this->flightTicketService->update($data);
        if (!$ticket) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true], 201);
    }

    // destroy
    public function destroy(string $id)
    {
        $ticket = $this->flightTicketService->destroy($id);
        if (!$ticket) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true], 200);
    }
    // changeStatus
    public function changeStatus(Request $request)
    {
        $ticket = $this->flightTicketService->changeStatus($request['id'], $request['statusSwitch']);
        if (!$ticket) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true], 200);
    }

    public function export(Request $request)
    {
        $selectedColumns = $request->input('columns', ['id', 'title', 'details', 'price', 'status']);

        return response()->json(Excel::download(new TicketExport(FlightTicket::get(), $selectedColumns), 'tickets.xlsx'));

        // $filters = $request->only(['status']); // Get filters from request
        // $selectedColumns = $request->input('columns', ['id', 'name']); // Get selected columns from request
        //  return Excel::download(new AdminsExport($filters, $selectedColumns), 'dynamic_users.xlsx');
    }
}
