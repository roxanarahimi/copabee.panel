<?php

namespace App\Http\Resources;

use App\Http\Controllers\DateController;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=> $this->id,
            'title'=> $this->title,
            'title_en'=> $this->title_en,
            'slug'=> $this->slug,
            'slug_en'=> $this->slug_en,
            'category'=> $this->category,
            'image'=> $this->image,
            'text'=> str_replace('src="/storage','src="https://dev-amadeh.ir:8084/storage',$this->text),
            'text_en'=> str_replace('src="/storage','src="https://dev-amadeh.ir:8084/storage',$this->text_en),
            'meta_description'=> $this->meta_description,
            'meta_description_'=> $this->meta_description_,
            'visible'=> $this->visible,

            'view'=> $this->view,
            'like'=> $this->like,
            'dislike'=> $this->dislike,
            'score'=> $this->score,
            'created_at'=> explode(' ', (new DateController())->toPersian($this->created_at))[0],
        ];
    }
}
