<?php

namespace App\Http\Controllers;

use App\Http\Resources\BannerResource;
use App\Http\Resources\ContentResource;
use App\Models\Banner;
use App\Models\City;
use App\Models\Collaboration;
use App\Models\Complane;
use App\Models\Content;
use App\Models\Province;
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
            return response(BannerResource::collection($banners),200);
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
                $data[]=["title"=>$item->title, "link"=> '/content/'.$item->slug];
            }
        }
        return response($data,200);

    }
    public function storeMessage(Request $request)
    {
        try {
            $message = \App\Models\Message::create($request->all());
            return response($message, 201);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function storeCollaboration(Request $request)
    {
        try {
            $uploadedFiles = [];
            foreach ($request->file('images') as $file) {
                // ✅ Store file in storage/app/public/userUploads
                $path = $file->store('userUploads', 'public');

                // ✅ Generate public URL (after storage:link)
                $url = asset('storage/' . $path);
                $uploadedFiles[] = $path;
            }
            $collaboration = Collaboration::create($request->except('images'));
            $collaboration->update(['images' => json_encode($uploadedFiles) ]);
            return response($collaboration, 201);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function storeComplane(Request $request)
    {
        try {
            $complane = Complane::create($request->all());
            return response($complane, 201);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function getProvinces()
    {
        try {
            $data = Province::orderBy('name')->get();
            return response($data,200);
        }catch(\Exception $exception){
            return $exception;
        }
    }


    public function getCities(Request $request)
    {
        try {
            if ($request['province_id']){
                $data = City::orderBy('name')->where('province_id',$request['province_id'])->get();
            }else{
                $data = City::orderBy('name')->get();
            }
            return response($data,200);
        }catch(\Exception $exception){
            return $exception;
        }
    }
}
