<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
Route::options('/{any}', function (Request $request) {
    return response('', 200)
        ->header('Access-Control-Allow-Origin', 'https://asallaziz.com')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
        ->header('Access-Control-Allow-Credentials', 'true');
})->where('any', '.*');

    Route::controller(App\Http\Controllers\ClientSideController::class)->group(function () {
        Route::get('/get/contents/{id}', 'contents');
        Route::get('/get/content/{slug}', 'content');
        Route::get('/get/banners', 'banners');
    });

