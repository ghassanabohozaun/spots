<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CountryRequest;
use App\Models\Country;
use App\Services\Dashboard\CountryService;
use App\Services\Dashboard\GovernorateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountriesController extends Controller
{
    protected $countryService, $governorateService;

    // __construct
    public function __construct(CountryService $countryService, GovernorateService $governorateService)
    {
        $this->countryService = $countryService;
        $this->governorateService = $governorateService;
    }

    // index
    public function index()
    {
        $title = __('world.countries');
        $countries = $this->countryService->getCountries();
        return view('dashboard.world.countries.index', compact('title', 'countries'));
    }

    // get governorate by country id
    public function getGovrnoratesByCountryID($country_id)
    {
        $title = __('world.governorates');
        $governorates = $this->countryService->getAllGovernoratiesByCountry($country_id);
        return view('dashboard.world.governorates.index', compact('title', 'governorates'));
    }

    // create
    public function create()
    {
        $title = __('world.create_new_country');
        return view('dashboard.world.countries.create', compact('title'));
    }

    // store
    public function store(CountryRequest $request)
    {
        $data = $request->only(['name', 'phone_code', 'flag_code', 'status']);
        $country = $this->countryService->storeCountry($data);
        if (!$country) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true, 'data' => $country], 201);
    }

    //show
    public function show(string $id)
    {
        //
    }

    //edit
    public function edit(string $id)
    {
        $title = __('world.update_country');
        $country = $this->countryService->getCountry($id);
        if (!$country) {
            flash()->error(__('general.no_record_found'));
            return redirect()->back();
        }
        return view('dashboard.world.countries.edit', compact('title', 'country'));
    }

    // update
    public function update(CountryRequest $request, string $id)
    {
        $country = $this->countryService->getCountry($id);
        if (!$country) {
            flash()->error(__('general.no_record_found'));
            return redirect()->back();
        }

        $data = $request->only(['name', 'phone_code', 'flag_code', 'status']);
        $country = $this->countryService->updateCountry($data, $id);
        if (!$country) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true, 'data' => $country], 200);
    }

    // destroy
    public function destroy(Request $request)
    {
        if ($request->json()) {
            $country = $this->countryService->destroyCountry($request->id);
            // if ($country == 'notFound') {
            //     return response()->json(['status' => 'notFound'], 500);
            // } elseif ($country == 'notUpdate') {
            //     return response()->json(['status' => 'notUpdate'], 500);
            // } elseif ($country == 'hasGovernorate') {
            //     return response()->json(['status' => 'hasGovernorate'], 500);
            // }
            if (!$country) {
                return response()->json(['status' => false], 500);
            }
            return response()->json(['status' => true], 200);
        }
    }

    // change status
    public function changeStatus(Request $request)
    {
        if ($request->json()) {
            $country = $this->countryService->changeStatus($request->id, $request->statusSwitch);
            if (!$country) {
                return response()->json(['status' => false], 500);
            }

            $country = $this->countryService->getCountry($request->id);
            return response()->json(['status' => true, 'data' => $country], 200);
        }
    }

    // get all governoratis by county
    public function getAllGovernoratiesByCountry(Request $request)
    {
        if ($request->json()) {
            $governoraties = $this->countryService->getAllGovernoratiesByCountry($request->id);
            return response()->json(['data' => $governoraties]);
        }
    }
}
