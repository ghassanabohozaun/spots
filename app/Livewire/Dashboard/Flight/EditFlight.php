<?php

namespace App\Livewire\Dashboard\Flight;

use Livewire\Component;
use App\Models\Flight;
use App\Services\Dashboard\CityService;
use App\Services\Dashboard\CountryService;
use App\Services\Dashboard\FlightService;
use App\Services\Dashboard\GovernorateService;
use Illuminate\Validation\Rule;
use Laravel\Prompts\FormBuilder;
use Livewire\WithFileUploads;
class EditFlight extends Component
{
    use WithFileUploads;
    public $successMessage = '';
    public $currentStep = 1,
        $disabledGovernorate = 0;
    public $name_ar, $name_en, $details_ar, $details_en, $days_num, $nights_num, $offer_duration_from, $offer_duration_to;
    public $country_id, $city_id, $category_id;
    public $countries, $cities, $categories;
    // servcices
    public $servicesItems = [],
        $pricesItems = [],
        $notesItems = [],
        $offerIncludingItems = [],
        $offerNotIncludingItems = [];

    public $flightServices = [],
        $flightPrices = [],
        $flightNotes = [],
        $flightIncludings = [],
        $flightNotIncludings = [];
    public $images, $newImages;

    public ?Flight $flight;
    protected FlightService $flightService;
    protected CountryService $countryService;
    protected CityService $cityService;
    // boot
    public function boot(FlightService $flightService, CountryService $countryService, CityService $cityService)
    {
        $this->flightService = $flightService;
        $this->countryService = $countryService;
        $this->cityService = $cityService;
    }

    // mount
    public function mount($countries, $cities, $categories, $FlightID)
    {
        // $this->servicesItems[] = ['service_name_ar' => '', 'service_name_en' => ''];
        // $this->pricesItems[] = ['price_text_ar' => '', 'price_text_en' => '', 'price' => '', 'main_option' => ''];
        // $this->notesItems[] = ['note_text_ar' => '', 'note_text_en' => ''];
        // $this->offerIncludingItems[] = ['including_text_ar' => '', 'including_text_en' => ''];
        // $this->offerNotIncludingItems[] = ['not_including_text_ar' => '', 'not_including_text_en' => ''];
        $this->categories = $categories;
        $this->countries = $countries;
        //$this->governorate_id ?? ($this->cities = []);
        $this->cities = $cities;

        $this->flight = $this->flightService->getFlightsWithRelations($FlightID);
        $this->name_ar = $this->flight->getTranslation('name', 'ar');
        $this->name_en = $this->flight->getTranslation('name', 'en');
        $this->details_ar = $this->flight->getTranslation('details', 'ar');
        $this->details_en = $this->flight->getTranslation('details', 'en');
        $this->days_num = $this->flight->days_num;
        $this->nights_num = $this->flight->nights_num;
        $this->offer_duration_from = $this->flight->offer_duration_from;
        $this->offer_duration_to = $this->flight->offer_duration_to;
        $this->country_id = $this->flight->country_id;
        $this->city_id = $this->flight->city_id;
        $this->category_id = $this->flight->category_id;

        $this->images = $this->flight->images;
        // services
        $this->flightServices = $this->flight->flightServices;
        foreach ($this->flightServices as $key => $serviceItem) {
            $this->servicesItems[$key]['service_name_ar'] = $serviceItem->getTranslation('name', 'ar');
            $this->servicesItems[$key]['service_name_en'] = $serviceItem->getTranslation('name', 'en');
        }

        // prices
        $this->flightPrices = $this->flight->flightPrices;
        foreach ($this->flightPrices as $key => $priceItem) {
            $this->pricesItems[$key]['price_text_ar'] = $priceItem->getTranslation('text', 'ar');
            $this->pricesItems[$key]['price_text_en'] = $priceItem->getTranslation('text', 'en');
            $this->pricesItems[$key]['price'] = $priceItem->price;
            $this->pricesItems[$key]['main_option'] = $priceItem->main_option;
        }

        // notes
        $this->flightNotes = $this->flight->flightNotes;
        foreach ($this->flightNotes as $key => $noteItem) {
            $this->notesItems[$key]['note_text_ar'] = $noteItem->getTranslation('text', 'ar');
            $this->notesItems[$key]['note_text_en'] = $noteItem->getTranslation('text', 'en');
        }

        // includings
        $this->flightIncludings = $this->flight->flightIncludings;
        foreach ($this->flightIncludings as $key => $includingItem) {
            $this->offerIncludingItems[$key]['including_text_ar'] = $includingItem->getTranslation('text', 'ar');
            $this->offerIncludingItems[$key]['including_text_en'] = $includingItem->getTranslation('text', 'en');
        }

        // not includings
        $this->flightNotIncludings = $this->flight->flightNotIncludings;
        foreach ($this->flightNotIncludings as $key => $notIncludingItem) {
            $this->offerNotIncludingItems[$key]['not_including_text_ar'] = $notIncludingItem->getTranslation('text', 'ar');
            $this->offerNotIncludingItems[$key]['not_including_text_en'] = $notIncludingItem->getTranslation('text', 'en');
        }
    }

    protected function rules()
    {
        // return [
        //     'personal_id' => ['required', 'numeric', 'digits:9', Rule::unique('children')->ignore($this->child)],
        //     'father_personal_id' => ['required', 'numeric', 'digits:9'],
        //     'mother_personal_id' => ['required', 'numeric', 'digits:9'],
        //     'guardian_personal_id' => ['required', 'numeric', 'digits:9'],
        // ];
    }

    // updated hock
    public function updated()
    {
        // $this->validate();
        //$this->validateOnly('personal_id'); // use when you need to validate specific input
    }

    // first step basic
    public function firstStepSubmit()
    {
        $data = [
            'name_ar' => ['required', 'string', 'min:3', 'max:255'],
            'name_en' => ['required', 'string', 'min:3', 'max:255'],
            'details_ar' => ['required', 'string', 'min:10', 'max:1000'],
            'details_en' => ['required', 'string', 'min:10', 'max:1000'],
            'days_num' => ['required', 'numeric'],
            'nights_num' => ['required', 'numeric'],
            'offer_duration_from' => ['required', 'date'],
            'offer_duration_to' => ['required', 'date'],
            'country_id' => ['required', 'exists:countries,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'category_id' => ['required', 'exists:categories,id'],
        ];

        $this->validate($data);

        $this->currentStep = 2;
    }

    // second step services
    public function secondStepSubmit()
    {
        $data = [
            'servicesItems' => ['required', 'array'],
            'servicesItems.*.service_name_ar' => ['required', 'string', 'min:3', 'max:255'],
            'servicesItems.*.service_name_en' => ['required', 'string', 'min:3', 'max:255'],
        ];

        $this->validate($data);

        $this->currentStep = 3;
    }

    // third step prices
    public function thirdStepSubmit()
    {
        $data = [
            'pricesItems' => ['required', 'array'],
            'pricesItems.*.price_text_ar' => ['required', 'string', 'min:3', 'max:255'],
            'pricesItems.*.price_text_en' => ['required', 'string', 'min:3', 'max:255'],
            'pricesItems.*.price' => ['required', 'numeric'],
            // 'pricesItems.*.main_option' => ['required', 'array', 'min:1'],
        ];

        $this->validate($data);

        $this->currentStep = 4;
    }

    // forth step sub categories
    public function forthStepSubmit()
    {
        $data = [
            'notesItems' => ['required', 'array'],
            'notesItems.*.note_text_ar' => ['required', 'string', 'min:3', 'max:255'],
            'notesItems.*.note_text_en' => ['required', 'string', 'min:3', 'max:255'],

            'offerIncludingItems' => ['required', 'array'],
            'offerIncludingItems.*.including_text_ar' => ['required', 'string', 'min:3', 'max:255'],
            'offerIncludingItems.*.including_text_en' => ['required', 'string', 'min:3', 'max:255'],

            'offerNotIncludingItems' => ['required', 'array'],
            'offerNotIncludingItems.*.not_including_text_ar' => ['required', 'string', 'min:3', 'max:255'],
            'offerNotIncludingItems.*.not_including_text_en' => ['required', 'string', 'min:3', 'max:255'],
        ];

        $this->validate($data);

        $this->currentStep = 5;
    }

    // fifth step images
    public function fifthStepSubmit()
    {
        // dd('dfdf');
        // $this->validate([
        //     'newImages' => ['required', 'array'],
        // ]);

        $this->currentStep = 6;
    }

    // back setp
    public function backStep($step)
    {
        $this->currentStep = $step;
    }

    // submit Form
    public function submitForm()
    {
        // basic data
        $basicData = [
            'name' => ['ar' => $this->name_ar, 'en' => $this->name_en],
            'slug' => ['ar' => slug($this->name_ar), slug($this->name_en)],
            'details' => ['ar' => $this->details_ar, 'en' => $this->details_en],
            'days_num' => $this->days_num,
            'nights_num' => $this->nights_num,
            'offer_duration_from' => $this->offer_duration_from,
            'offer_duration_to' => $this->offer_duration_to,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'category_id' => $this->category_id,
        ];

        //services data
        $servicesData = [];
        foreach ($this->servicesItems as $index => $name) {
            $servicesData[] = [
                'flight_id' => null,
                'name' => ['ar' => $this->servicesItems[$index]['service_name_ar'], 'en' => $this->servicesItems[$index]['service_name_en']] ?? 0,
            ];
        }

        // prices data
        $pricesData = [];
        foreach ($this->pricesItems as $index => $name) {
            $pricesData[] = [
                'flight_id' => null,
                'text' => ['ar' => $this->pricesItems[$index]['price_text_ar'], 'en' => $this->pricesItems[$index]['price_text_en']] ?? null,
                'price' => $this->pricesItems[$index]['price'] ?? 0,
                'main_option' => $this->pricesItems[$index]['main_option'] == true ? 1 : 0,
            ];
        } // end prices foreach

        //notes data
        $notesData = [];
        foreach ($this->notesItems as $index => $name) {
            $notesData[] = [
                'flight_id' => null,
                'text' => ['ar' => $this->notesItems[$index]['note_text_ar'], 'en' => $this->notesItems[$index]['note_text_en']] ?? 0,
            ];
        }

        //offer including data
        $offerIncludingData = [];
        foreach ($this->offerIncludingItems as $index => $name) {
            $offerIncludingData[] = [
                'flight_id' => null,
                'text' => ['ar' => $this->offerIncludingItems[$index]['including_text_ar'], 'en' => $this->offerIncludingItems[$index]['including_text_en']] ?? 0,
            ];
        }

        //offer not including data
        $offerNotIncludingData = [];
        foreach ($this->offerNotIncludingItems as $index => $name) {
            $offerNotIncludingData[] = [
                'flight_id' => null,
                'text' => ['ar' => $this->offerNotIncludingItems[$index]['not_including_text_ar'], 'en' => $this->offerNotIncludingItems[$index]['not_including_text_en']] ?? 0,
            ];
        }

        $flightUpdated = $this->flightService->updateFlight($this->flight, $basicData, $servicesData, $pricesData, $notesData, $offerIncludingData, $offerNotIncludingData, $this->newImages);

        if (!$flightUpdated) {
            flash()->error(message: __('general.add_error_message'));
            $this->currentStep = 1;
        } else {
            flash()->success(message: __('general.add_success_message'));
            // $this->resetExcept(['categories', 'countries', 'cities', 'successMessage']);
            $this->reset(['newImages']);
            $this->images = $this->flight->images;
            // $this->addNewService();
            // $this->addNewPrice();
            // $this->addNewNote();
            // $this->addNewOfferIncluding();
            // $this->addNewOfferNotIncluding();
            $this->currentStep = 1;
        }
    }

    // change country
    public function changeCountry($id)
    {
        if ($id != '') {
            $this->cities = [];
            $this->cities = [];
            $this->city_id = '';
            $this->cities = $this->countryService->getAllCitiesByCountry($id);
            $this->disabledGovernorate = 0;
        } else {
            $this->cities = [];
            $this->cities = [];
            $this->city_id = '';
            $this->disabledGovernorate = 1;
        }
    }

    ///++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
    // deals with images
    ///++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
    // delete old image
    public function deleteOldImage($key, $image)
    {
        $imageId = $image['id']; // to delete image from database
        $imageName = $image['file_name']; // to delete image from local

        $image = $this->flightService->deleteFlightImage($imageId, $imageName);

        if (!$image) {
            flash()->error(__('general.delete_image_error_message'));
        }

        unset($this->images[$key]); // to delete image from temporery
        flash()->success(__('general.delete_image_success_message'));
    }

    // delete new image
    public function deleteNewImage($key)
    {
        unset($this->newImages[$key]);
        flash()->success(__('general.delete_image_success_message'));
    }

    ///++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
    // services
    ///++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//

    // add new service
    public function addNewService()
    {
        $this->servicesItems[] = ['service_name_ar' => '', 'service_name_en' => ''];
    }

    // remove service
    public function removeService($index)
    {
        if (count($this->servicesItems) > 1) {
            unset($this->servicesItems[$index]);
            //$this->servicesItems = array_values($this->servicesItems); // Re-index the array
        }
    }

    ///++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
    // prices
    ///++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//

    // add new service
    public function addNewPrice()
    {
        $this->pricesItems[] = ['price_text_ar' => '', 'price_text_en' => '', 'price' => '', 'main_option' => ''];
    }

    // remove service
    public function removePrice($index)
    {
        if (count($this->pricesItems) > 1) {
            unset($this->pricesItems[$index]);
            //$this->servicesItems = array_values($this->servicesItems); // Re-index the array
        }
    }
    ///++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
    // notes
    ///++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//

    // add new note
    public function addNewNote()
    {
        $this->notesItems[] = ['note_text_ar' => '', 'note_text_en' => ''];
    }

    // remove service
    public function removeNote($index)
    {
        if (count($this->notesItems) > 1) {
            unset($this->notesItems[$index]);
            //$this->servicesItems = array_values($this->servicesItems); // Re-index the array
        }
    }
    ///++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
    // offer including
    ///++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//

    // add new offer including
    public function addNewOfferIncluding()
    {
        $this->offerIncludingItems[] = ['including_text_ar' => '', 'including_text_en' => ''];
    }

    // remove offer including
    public function removeOfferIncluding($index)
    {
        if (count($this->offerIncludingItems) > 1) {
            unset($this->offerIncludingItems[$index]);
            //$this->offerIncludingItems = array_values($this->offerIncludingItems); // Re-index the array
        }
    }
    ///++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
    // offer not including
    ///++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//

    // add new offer not including
    public function addNewOfferNotIncluding()
    {
        $this->offerNotIncludingItems[] = ['not_including_text_ar' => '', 'not_including_text_en' => ''];
    }

    // remove offer not including
    public function removeOfferNotIncluding($index)
    {
        if (count($this->offerNotIncludingItems) > 1) {
            unset($this->offerNotIncludingItems[$index]);
            //$this->offerNotIncludingItems = array_values($this->offerNotIncludingItems); // Re-index the array
        }
    }

    // main option change
    public function mainOptionChange($index)
    {
        foreach ($this->pricesItems as $i => $name) {
            $this->pricesItems[$i]['main_option'] = false;
        }

        $this->pricesItems[$index]['main_option'] = true;
    }
    // render
    public function render()
    {
        return view('livewire.dashboard.flight.edit-flight', [
            'countries' => $this->countries,
            'cities' => $this->cities,
            'categories' => $this->categories,
        ]);
    }
}
