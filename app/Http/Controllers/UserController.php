<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Collaboration;
use App\Models\Complane;
use http\Client\Curl\User;
use http\Message;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function sendOtp(Request $request)
    {
        try {
            $code = rand(1001, 9999);
            $text = ' به کوپابی خوش آمدید.
        کد تایید شما:
        ' . $code;

            $sms = ["mobie" => $request['mobile'], "text" => $text];
            $send = $this->sendSms($sms);
            if ($send->status === 200) {
                $user = User::where('mobile', $request['mobile'])->first();
                if ($user && $user->role === 'admin') {
                    return response(['message' => 'این شماره قابل استفاده نیست. لطفا با شماره دیگری تلاش کنید.'], 422);
                }
                if (!$user) {
                    $this->storeUser($request);
                }
                return response(['message' => 'کد تایید برای شما پیامک شد. لطفا در کادر زیر وارد کنید.'], 200);
            }
        } catch (\Exception $exception) {
            return $exception;
        }

    }

    public function sendSms(Request $request)
    {
        //.......
        return response(['message' => 'پیامک با موفقیت ارسال شد.'], 200);
    }

    public function verifyMobile(Request $request)
    {
        try {
            $user = User::where('mobile', $request['mobile'])->first();
            if ($user->otp === $request['otp']) {
                return response(['message'=>'شماره موبایل با موفقیت تایید شد.'],200);
            }else{
                return response(['message'=>'کد تایید وارد شده اشتباه است.'],422);
            }
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function storeUser(Request $request)
    {
        try {
            $user = User::create($request->all('mobile','type'));
            return response(new UserResource($user),201);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function storeMessage(Request $request)
    {
        try {
            $message = \App\Models\Message::create($request->all());
            return response($message,201);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function storeCollaboration(Request $request)
    {
        try {
            $collaboration = Collaboration::create($request->all());
            return response($collaboration,201);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function storeComplane(Request $request)
    {
        try {
            $complane = Complane::create($request->all());
            return response($complane,201);
        } catch (\Exception $exception) {
            return $exception;
        }
    }
}
