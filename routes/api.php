<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::options('/{any}', function (Request $request) {
    return response('', 200)
        ->header('Access-Control-Allow-Origin', '*')//aa
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
        ->header('Access-Control-Allow-Credentials', 'true');
})->where('any', '.*');

Route::controller(App\Http\Controllers\ClientSideController::class)->group(function () {
    Route::get('/get/contents/{id}', 'contents');
    Route::get('/get/content/{slug}', 'content');
    Route::get('/get/banners', 'banners');
    Route::get('/search', 'search');

    Route::post('/register', 'register');
    Route::get('/form/contact', 'search');
    Route::get('/form/collaborate', 'search');
    Route::get('/form/message', 'search');

    Route::post('/message/store', 'storeMessage');
    Route::post('/collab/store', 'storeCollaboration');
    Route::post('/complane/store', 'storeComplane');

    Route::get('/get/provinces', 'getProvinces');
    Route::get('/get/cities', 'getCities');

});

Route::controller(App\Http\Controllers\UserController::class)->group(function () {
    Route::post('/user/otp', 'sendOtp');
    Route::post('/user/verify', 'verifyMobile');
    Route::post('/user/store', 'store');
});

Route::controller(App\Http\Controllers\UserController::class)->group(function () {
    Route::post('/test', 'sendSms');

});


