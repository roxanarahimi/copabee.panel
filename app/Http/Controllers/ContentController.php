<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContentResource;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index($id)
    {
        try {
            $contents = Content::where('visible',1)->where('category_id',$id)->get();
            return response(ContentResource::collection($contents),200);
        }catch(\Exception $exception){
            return $exception;
        }
    }
    public function show($slug)
    {
        try {
            $contents = Content::where('visible')->where('slug',$slug)->orWhere('slug_en',$slug)->get();
            return response(ContentResource::collection($contents),200);
        }catch(\Exception $exception){
            return $exception;
        }
    }
}
