<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContentResource;
use App\Models\Banner;
use App\Models\Content;
use http\Env\Response;
use Illuminate\Http\Request;
use function MongoDB\Driver\Monitoring\removeSubscriber;

class ClientSideController extends Controller
{
    public function contents($id)
    {
        try {
            $contents = Content::orderByDesc('created_at')->where('visible',1)->where('category_id',$id)->get();
            return response(ContentResource::collection($contents),200);
        }catch(\Exception $exception){
            return $exception;
        }
    }
    public function content($slug)
    {
        try {
            $content = Content::where('visible',1)->where('slug',$slug)->orWhere('slug_en',$slug)->first();
            return response(new ContentResource($content),200);
        }catch(\Exception $exception){
            return $exception;
        }
    }
    public function banners()
    {
        try {
            $banners = Banner::orderByDesc('created_at')->orderByDesc('id')->where('visible',1)->get();
            return response($banners,200);
        }catch(\Exception $exception){
            return $exception;
        }
    }

    public function otp(Request $request)
    {
        try {
            $banners = Banner::orderByDesc('id')->where('visible',1)->get();
            return response($banners,200);
        }catch(\Exception $exception){
            return $exception;
        }
    }
    public function verifyUser(Request $request)
    {
        try {
            $banners = Banner::orderByDesc('id')->where('visible',1)->get();
            return response($banners,200);
        }catch(\Exception $exception){
            return $exception;
        }
    }
    public function saveMessage(Request $request)
    {
        try {
            $banners = Banner::orderByDesc('id')->where('visible',1)->get();
            return response($banners,200);
        }catch(\Exception $exception){
            return $exception;
        }
    }

    public function search(Request $request)
    {
        $data = [];
        if(strlen($request['term'])>4){
            $contents = Content::orderByDesc('created_at')->where('visible',1)->where('title','Like','%'.$request['term'].'%')->get();
            foreach ($contents as $item){
                $data[]=["title"=>$item->title, "link"=> '/content'.$item->slug];
            }
        }
        return response($data,200);

    }

}
