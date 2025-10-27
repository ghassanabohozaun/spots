<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CityRequest;
use App\Services\Dashboard\CityService;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    protected $cityService;
    // __construct
    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }
    // index
    public function index()
    {
        $title = __('world.cities');
        $cities = $this->cityService->getCities();
        return view('dashboard.world.cities.index', compact('title', 'cities'));
    }



    //create
    public function create()
    {
        $title = __('world.create_new_city');
        return view('dashboard.world.cities.create', compact('title'));
    }

    // store
    public function store(CityRequest $request)
    {
        $data = $request->only(['name', 'country_id']);
        $city = $this->cityService->storeCity($data);
        if (!$city) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true, 'data' => $city], 200);
    }

    // show
    public function show(string $id)
    {
        //
    }

    // edit
    public function edit(string $id)
    {
        $title = __('world.update_city');
        $city = $this->cityService->getCity($id);

        if (!$city) {
            flash()->error(__('general.no_record_found'));
            return redirect()->back();
        }
        return view('dashboard.world.cities.edit', compact('title', 'city'));
    }

    // update
    public function update(CityRequest $request, string $id)
    {
        $city = $this->cityService->getCity($id);
        $data = $request->only(['name', 'country_id']);
        $city = $this->cityService->updateCity($data, $id);
        if (!$city) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true, 'data' => $city], 201);
    }

    // change status
    public function changeStatus($id)
    {
        $city = $this->cityService->changeStatus($id);
        if (!$city) {
            return response()->json(['status' => false], 500);
        }
        $city = $this->cityService->getCity($id);
        return response()->json(['status' => true, 'data' => $city]);
    }

    // destroy
    public function destroy(Request $request)
    {
        if ($request->json()) {
            $city = $this->cityService->destroyCity($request->id);
            if (!$city) {
                return response()->json(['status' => false], 500);
            }
            return response()->json(['status' => true], 200);
        }
    }


    // autocomplete city
    public function autocompleteCity(Request $request)
    {
        $data = [];
        if ($request->filled('q')) {
            $data = $this->cityService->autocompleteCity($request->get('q'));
        }
        return response()->json($data);
    }

}
