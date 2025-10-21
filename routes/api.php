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
        Route::post('/get/otp', 'otp');
        Route::post('/mobile/verify', 'verify');

        Route::post('/register', 'register');
        Route::get('/form/contact', 'search');
        Route::get('/form/collaborate', 'search');
        Route::get('/form/message', 'search');
    });

    Route::controller(App\Http\Controllers\UserController::class)->group(function () {
        Route::get('/get/user/otp', 'sendOtp');
        Route::get('/get/user/verify', 'verifyMobile');

        Route::get('/get/user/store', 'storeUser');
        Route::get('/get/message/store', 'storeMessage');
        Route::get('/get/collab/store', 'storeCollaboration');
        Route::get('/get/complane/store', 'storeComplane');
    });

  Route::controller(App\Http\Controllers\UserController::class)->group(function () {
        Route::post('/test', 'sendSms');

    });



