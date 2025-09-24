<?php
use Illuminate\Support\Facades\Route;
Route::options('/{any}', function (\Illuminate\Http\Request $request) {
    return response('', 200)
        ->header('Access-Control-Allow-Origin', 'https://asallaziz.com')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
})->where('any', '.*');

    Route::controller(App\Http\Controllers\ClientSideController::class)->group(function () {
        Route::get('/get/contents/{id}', 'contents');
        Route::get('/get/content/{slug}', 'content');
        Route::get('/get/banners', 'banners');
    });

