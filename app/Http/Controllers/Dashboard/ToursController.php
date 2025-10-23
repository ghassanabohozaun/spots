<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TourRequest;
use App\Services\Dashboard\CountryService;
use App\Services\Dashboard\GovernorateService;
use App\Services\Dashboard\TourService;
use Illuminate\Http\Request;

class ToursController extends Controller
{
    protected $tourService, $countryService, $governorateService;
    public function __construct(TourService $tourService, CountryService $countryService, GovernorateService $governorateService)
    {
        $this->tourService = $tourService;
        $this->countryService = $countryService;
        $this->governorateService = $governorateService;
    }

    // index
    public function index()
    {
        $title = __('tours.tours');
        return view('dashboard.tours.index', compact('title'));
    }

    public function getAll(Request $request)
    {
        return $this->tourService->getAll($request);
    }

    // create
    public function create()
    {
        $title = __('tours.create_new_tour');
        return view('dashboard.tours.create', compact('title'));
    }

    // store
    public function store(TourRequest $request)
    {
        $data = $request->only(['title', 'name', 'title', 'details', 'price', 'country_id', 'governorate_id', 'tour_guide_name', 'photo', 'status']);
        $tour = $this->tourService->store($data);
        if (!$tour) {
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
        $title = __('tours.update_tour');
        $tour = $this->tourService->getOne($id);
        if (!$tour) {
            flash()->error(__('general.no_record_found'));
            return redirect()->back();
        }
        $countries = $this->countryService->getActiveCountries();
        $governorates = $this->governorateService->getActiveGovernoraties();
        return view('dashboard.tours.edit', compact('title', 'tour', 'countries', 'governorates'));
    }

    // update
    public function update(TourRequest $request, string $id)
    {
        $data = $request->only(['id', 'title', 'name', 'title', 'details', 'price', 'country_id', 'governorate_id', 'tour_guide_name', 'photo', 'status']);
        $tour = $this->tourService->update($data);
        if (!$tour) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true], 201);
    }

    // destroy
    public function destroy(string $id)
    {
        $tour = $this->tourService->destroy($id);
        if (!$tour) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true], 200);
    }
    // changeStatus
    public function changeStatus(Request $request)
    {
        $tour = $this->tourService->changeStatus($request['id'], $request['statusSwitch']);
        if (!$tour) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true], 200);
    }

    public function export(Request $request)
    {
        // $selectedColumns = $request->input('columns', ['id', 'title', 'details', 'price', 'status']);

        // return response()->json(Excel::download(new TicketExport(FlightTicket::get(), $selectedColumns), 'tours.xlsx'));

        // $filters = $request->only(['status']); // Get filters from request
        // $selectedColumns = $request->input('columns', ['id', 'name']); // Get selected columns from request
        //  return Excel::download(new AdminsExport($filters, $selectedColumns), 'dynamic_users.xlsx');
    }
}
