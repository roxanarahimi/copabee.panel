<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'image'=> $this->image,
            'image_en'=> $this->image_en,
            'link'=> urldecode($this->link),
            'link_en'=> urldecode($this->link_en),
            'visible'=> $this->visible,
        ];
    }
}
