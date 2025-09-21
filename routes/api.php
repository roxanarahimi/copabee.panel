<?php
use Illuminate\Support\Facades\Route;

    Route::controller(App\Http\Controllers\ClientSideController::class)->group(function () {
        Route::get('/get/contents/{id}', 'contents');
        Route::get('/get/content/{slug}', 'content');
        Route::get('/get/banners', 'banners');
    });

