<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\FlightRepository;
use App\Utils\ImageManagerUtils;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class FlightService
{
    protected $flightRepository, $imageManagerUtils;
    /**
     * Create a new class instance.
     */
    public function __construct(FlightRepository $flightRepository, ImageManagerUtils $imageManagerUtils)
    {
        $this->flightRepository = $flightRepository;
        $this->imageManagerUtils = $imageManagerUtils;
    }

    // get flight
    public function getFlight($id)
    {
        $product = $this->flightRepository->getFlight($id);
        if (!$product) {
            return false;
        }
        return $product;
    }

    // get flight with relation
    public function getFlightsWithRelations($id)
    {
        $flight = $this->flightRepository->getFlightsWithRelations($id);
        if (!$flight) {
            return false;
        }
        return $flight;
    }

    // get flights
    public function getProdgetFlightsucts()
    {
        return $this->flightRepository->getFlights();
    }

    // get All
    public function getAll($request)
    {
        $flights = $this->flightRepository->getFlights($request);

        return DataTables::of($flights)
            ->addIndexColumn()
            ->addColumn('name', function ($flight) {
                return $flight->getTranslation('name', Lang());
            })
            ->addColumn('country_id', function ($flight) {
                return $flight->country->name;
            })
            ->addColumn('governorate_id', function ($flight) {
                return $flight->governorate->name;
            })

            ->addColumn('images', function ($flight) {
                return view('dashboard.flights.parts.images', compact('flight'));
            })

            ->addColumn('status', function ($flight) {
                return $flight->status == 1 ? __('general.active') : __('general.inactive');
            })

            ->addColumn('manage_status', function ($flight) {
                return view('dashboard.flights.parts.manage-status', compact('flight'));
            })

            ->addColumn('actions', function ($flight) {
                return view('dashboard.flights.parts.actions', compact('flight'));
            })

            ->make(true);
    }

    // // create product with details
    // public function createProductWithDetails($productData, $productVaraintsData, $images)
    // {
    //     try {
    //         DB::beginTransaction();

    //         $product = $this->flightRepository->createProduct($productData);

    //         if (!$product) {
    //             return false;
    //         }

    //         foreach ($productVaraintsData as $variantItem) {
    //             $variantItem['product_id'] = $product->id;
    //             $productVariant = $this->flightRepository->createProductVariants($variantItem);
    //             if (!$productVariant) {
    //                 return false;
    //             }

    //             foreach ($variantItem['attribute_value_ids'] as $attribute_value_id) {
    //                 $productVariantAttribues = $this->flightRepository->createProductVariantAttributes([
    //                     'product_variant_id' => $productVariant->id,
    //                     'attribute_value_id' => $attribute_value_id,
    //                 ]);

    //                 if (!$productVariantAttribues) {
    //                     return false;
    //                 }
    //             }
    //         }

    //         if (!empty($images)) {
    //             $this->imageManagerUtils->uploadImages($images, $product, 'products');
    //         }

    //         DB::commit();
    //         return true;
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         // dd($e->getMessage());
    //         Log::error('Error Creating Product  : ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
    //         return false;
    //     }
    // }

    // // update product with detalis
    // public function updateProductWithDetails($product, $productData, $productVaraintsData, $images)
    // {
    //     try {
    //         DB::beginTransaction();

    //         // update product
    //         $productUpdated = $this->flightRepository->updateProduct($product, $productData);
    //         if (!$productUpdated) {
    //             return false;
    //         }

    //         // delete old variants
    //         $this->flightRepository->destroyaAllProductVaraints($product);

    //         // create new varaints
    //         foreach ($productVaraintsData as $variantItem) {
    //             $variantItem['product_id'] = $product->id;
    //             $productVariantUpdated = $productVariant = $this->flightRepository->createProductVariants($variantItem);
    //             if (!$productVariantUpdated) {
    //                 return false;
    //             }

    //             foreach ($variantItem['attribute_value_ids'] as $attribute_value_id) {
    //                 $productVariantAttributesUpdated = $this->flightRepository->createProductVariantAttributes([
    //                     'product_variant_id' => $productVariant->id,
    //                     'attribute_value_id' => $attribute_value_id,
    //                 ]);
    //                 if (!$productVariantAttributesUpdated) {
    //                     return false;
    //                 }
    //             }
    //         }

    //         // create new image -> old image delete by delete button in front

    //         if (!empty($images)) {
    //             $this->imageManagerUtils->uploadImages($images, $product, 'products');
    //         }

    //         DB::commit();
    //         return true;
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         // dd($e->getMessage());
    //         Log::error('Error Creating Product  : ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
    //         return false;
    //     }
    // }


    // destroy flight
    public function destroyFlight($id)
    {
        $flight = self::getFlight($id);
        $flight = $this->flightRepository->destroyFlight($flight);
        if (!$flight) {
            return false;
        }
        return $flight;
    }

    // change status
    public function changeStatus($id, $status)
    {
        $flight = self::getFlight($id);
        $flight = $this->flightRepository->changeStatus($flight, $status);
        if (!$flight) {
            return false;
        }
        return $flight;
    }
}
