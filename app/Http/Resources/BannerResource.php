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
            'link'=> mb_convert_encoding(urldecode($this->link), 'UTF-8', 'UTF-8'),
            'link_en'=> mb_convert_encoding(urldecode($this->link_en), 'UTF-8', 'UTF-8'),
            'visible'=> $this->visible,
        ];
    }
}
