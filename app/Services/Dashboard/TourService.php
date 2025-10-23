<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\TourRepository;
use App\Utils\ImageManagerUtils;
use Yajra\DataTables\Facades\DataTables;

class TourService
{
    protected $tourRepository, $imageManagerUtils;
    // __construct
    public function __construct(TourRepository $tourRepository, ImageManagerUtils $imageManagerUtils)
    {
        $this->tourRepository = $tourRepository;
        $this->imageManagerUtils = $imageManagerUtils;
    }

    // get tour
    public function getOne($id)
    {
        $tour = $this->tourRepository->getOne($id);
        if (!$tour) {
            return false;
        }
        return $tour;
    }

    // get tours
    // public function getAllTours()
    // {
    //     return $this->tourRepository->getAll();
    // }

    // get tours
    public function getActive()
    {
        return $this->tourRepository->getActive();
    }

    // get all
    public function getAll($request)
    {
        $tours = $this->tourRepository->getAll($request);

        return DataTables::of($tours)
            ->addIndexColumn()
            ->addColumn('photo', function ($tour) {
                return view('dashboard.tours.parts.photo', compact('tour'));
            })
            ->addColumn('name', function ($tour) {
                return $tour->getTranslation('name', Lang());
            })
            ->addColumn('title', function ($tour) {
                return $tour->getTranslation('title', Lang());
            })
            ->addColumn('details', function ($tour) {
                return $tour->getTranslation('details', Lang());
            })
            ->addColumn('country_id', function ($tour) {
                return $tour->country->name;
            })
            ->addColumn('governorate_id', function ($tour) {
                return $tour->governorate->name;
            })
            ->addColumn('created_at', function ($tour) {
                return $tour->created_at;
            })
            ->addColumn('status', function ($tour) {
                return view('dashboard.tours.parts.status', compact('tour'));
            })
            ->addColumn('manage_status', function ($tour) {
                return view('dashboard.tours.parts.manage-status', compact('tour'));
            })
            ->addColumn('actions', function ($tour) {
                return view('dashboard.tours.parts.actions', compact('tour'));
            })
            ->make(true);
    }

    // store tour
    public function store($data)
    {
        if (array_key_exists('photo', $data) && $data['photo'] != null) {
            $photo_name = $this->imageManagerUtils->saveResizeImage($data['photo'], 'tours', 1000, 1000);
            $data['photo'] = $photo_name;
        }

        $tour = $this->tourRepository->store($data);
        if (!$tour) {
            return false;
        }
        return $tour;
    }

    //update tour
    public function update($data)
    {
        $tour = self::getOne($data['id']);
        if (!$tour) {
            return false;
        }

        if (array_key_exists('photo', $data) && $data['photo'] != null) {
            $this->imageManagerUtils->removeImageFromLocal($tour->photo, 'tours');
            $photo_name = $this->imageManagerUtils->saveResizeImage($data['photo'], 'tours', 1000, 1000);
            $data['photo'] = $photo_name;
        }

        $tour = $this->tourRepository->update($tour, $data);
        if (!$tour) {
            return false;
        }
        return $tour;
    }

    // destroy tour
    public function destroy($id)
    {
        $tour = self::getOne($id);
        if (!$tour) {
            return false;
        }
        if (!empty($tour->photo)) {
            $this->imageManagerUtils->removeImageFromLocal($tour->photo, 'tours');
        }

        $tour = $this->tourRepository->destroy($tour);
        if (!$tour) {
            return false;
        }
        return $tour;
    }

    // change status
    public function changeStatus($id, $status)
    {
        $tour = self::getOne($id);
        if (!$tour) {
            return false;
        }
        $tour = $this->tourRepository->changeStatus($tour, $status);
        if (!$tour) {
            return false;
        }
        return $tour;
    }
}
