<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'details' => $this->details,
            'url' => $this->url,
            'order' => $this->order,
            'details_status' => $this->details_status,
            'button_status' => $this->button_status,
            'status' => $this->status,
            'photo' => $this->getImageUrl($this->photo , 'sliders') ,
        ];
    }
}
