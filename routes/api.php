<?php

use App\Http\Middleware\CorsMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware([CorsMiddleware::class])->group(function () {

    Route::controller(App\Http\Controllers\ClientSideController::class)->group(function () {
        Route::get('/get/contents/{id}', 'contents');
        Route::get('/get/content/{slug}', 'content');
        Route::get('/get/banners', 'banners');
    });

});
