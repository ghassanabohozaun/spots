<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\City;
 use App\Services\Dashboard\CityService;
use App\Services\Dashboard\CountryService;
use App\Services\Dashboard\FlightService;
use App\Services\Dashboard\GovernorateService;
use Illuminate\Http\Request;

class FlightsController extends Controller
{
    protected $flightService, $countryService, $governorateService, $cityService, $sponsershipOrganizationService, $sponsershipStatusService, $sponsershipTypeService;
    // __construct

    public function __construct(FlightService $flightService, CountryService $countryService, GovernorateService $governorateService, CityService $cityService)
    {
        $this->flightService = $flightService;
        $this->countryService = $countryService;
        $this->governorateService = $governorateService;
        $this->cityService = $cityService;
    }

    // index
    public function index()
    {
        $title = __('flights.show_all_flights');
        $countries = $this->countryService->getAllCountriesWithoutRelations();
        $governorates = $this->governorateService->getAllGovernoratesWithoutRelations();
        $cities = $this->cityService->getAllCitiesWithoutRelation();

        return view('dashboard.flights.index', compact('title', 'countries', 'governorates', 'cities'));
    }

    // get All
    public function getAll(Request $request)
    {
        return $this->flightService->getAll($request);
    }

    // create
    public function create()
    {
        $title = __('flights.create_new_flight');
        $countries = $this->countryService->getAllCountriesWithoutRelations();
        $governorates = $this->governorateService->getAllGovernoratesWithoutRelations();
        $cities = $this->cityService->getAllCitiesWithoutRelation();
        return view('dashboard.children.create', compact('title', 'countries', 'governorates', 'cities'));
    }

    // store
    public function store(Request $request)
    {
        //
    }

    // show
    public function show(string $id)
    {
        $flight = $this->flightService->getFlightsWithRelations($id);
        if (!$flight) {
            flash()->error(__('general.no_record_found'));
            return redirect()->route('dashboard.flights.index');
        }

        $title = __('flights.show_flight');
        $countries = $this->countryService->getAllCountriesWithoutRelations();
        $governorates = $this->governorateService->getAllGovernoratesWithoutRelations();
        $cities = $this->cityService->getAllCitiesWithoutRelation();
        $FlightID = $id;
        return view('dashboard.flights.show', compact('title', 'FlightID', 'flight'));
    }

    // edit
    public function edit(string $id)
    {
        $flight = $this->flightService->getFlightsWithRelations($id);
        if (!$flight) {
            flash()->error(__('general.no_record_found'));
            return redirect()->route('dashboard.flights.index');
        }
        $title = __('flights.update_flight');
        $countries = $this->countryService->getAllCountriesWithoutRelations();
        $governorates = $this->governorateService->getAllGovernoratesWithoutRelations();
        $cities = $this->cityService->getAllCitiesWithoutRelation();
        $FlightID = $id;
        return view('dashboard.children.edit', compact('title', 'FlightID', 'flight'));
    }

    // update
    public function update(Request $request, string $id)
    {
        //
    }

    // destroy
    public function destroy(string $id)
    {
        $flight = $this->flightService->destroyFlight($id);
        if (!$flight) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true], 200);
    }

    // changeStatus
    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            $flight = $this->flightService->changeStatus($request->id, $request->statusSwitch);
            if (!$flight) {
                return response()->json(['status' => false], 500);
            }
            return response()->json(['status' => true], 200);
        }
    }

    // get cities
    public function getCities($governorate_id)
    {
        $cities = City::where('governorate_id', $governorate_id)->pluck('name', 'id');
        return response()->json($cities);
    }
}
