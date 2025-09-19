<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContentResource;
use App\Models\Banner;
use App\Models\Content;
use Illuminate\Http\Request;

class ClientSideController extends Controller
{
    public function contents($id)
    {
        try {
            $contents = Content::where('visible',1)->where('category_id',$id)->get();
            return response(ContentResource::collection($contents),200);
        }catch(\Exception $exception){
            return $exception;
        }
    }
    public function content($slug)
    {
        try {
            $contents = Content::where('visible')->where('slug',$slug)->orWhere('slug_en',$slug)->get();
            return response(ContentResource::collection($contents),200);
        }catch(\Exception $exception){
            return $exception;
        }
    }
    public function banners()
    {
        try {
            $banners = Banner::orderBy('id')->where('visible',1)->get();
            return response($banners,200);
        }catch(\Exception $exception){
            return $exception;
        }
    }

}
