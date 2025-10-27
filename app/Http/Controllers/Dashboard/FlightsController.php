<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Services\Dashboard\CategorySevice;
use App\Services\Dashboard\CityService;
use App\Services\Dashboard\CountryService;
use App\Services\Dashboard\FlightService;
use Illuminate\Http\Request;

class FlightsController extends Controller
{
    protected $flightService, $countryService, $cityService, $sponsershipOrganizationService, $sponsershipStatusService, $sponsershipTypeService, $categorySevice;
    // __construct

    public function __construct(FlightService $flightService, CountryService $countryService, CityService $cityService  ,CategorySevice $categorySevice)
    {
        $this->flightService = $flightService;
        $this->countryService = $countryService;
        $this->cityService = $cityService;
        $this->categorySevice = $categorySevice;
    }

    // index
    public function index()
    {
        $title = __('flights.show_all_flights');
        $countries = $this->countryService->getAllCountriesWithoutRelations();
        $cities = $this->cityService->getAllCitiesWithoutRelations();
        $categories = $this->categorySevice->getCategories();
        return view('dashboard.flights.index', compact('title', 'countries', 'cities', 'categories'));
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
        $cities = $this->cityService->getAllCitiesWithoutRelations();
        $categories = $this->categorySevice->getCategories();
        return view('dashboard.flights.create', compact('title', 'countries', 'cities', 'categories'));
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
        $cities = $this->cityService->getAllCitiesWithoutRelations();
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
        $cities = $this->cityService->getAllCitiesWithoutRelations();
        $categories = $this->categorySevice->getCategories();
        $FlightID = $id;
        return view('dashboard.flights.edit', compact('title', 'FlightID', 'flight','countries','cities','categories'));
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
    public function getCities($country_id)
    {
        $cities = City::where('country_id', $country_id)->pluck('name', 'id');
        return response()->json($cities);
    }
}
