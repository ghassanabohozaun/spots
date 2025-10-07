<?php

namespace App\Services\Api;

use App\Models\Category;
use App\Repositories\Api\GlobalRepository;

class GlobalService
{
    protected $globalRepository;
    public function __construct(GlobalRepository $globalRepository)
    {
        $this->globalRepository = $globalRepository;
    }

    // get settings
    public function getSettings() {
        return $this->globalRepository->getSettings();
    }

    // get sliders
    public function getSliders($limit = null)
    {
        return $this->globalRepository->getSliders($limit);
    }
}
