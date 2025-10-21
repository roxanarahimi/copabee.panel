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
                    $user = $this->store($request->all('mobile', 'type', 'name', 'email', 'city_id'));
                }
                //save code in db ....
                $sms = $this->sendSms(['mobile' => $request->mobile, 'text' => $text]);
                if ($sms->status === 200) {
                    return response(['user' => $user, 'message' => 'کد تایید برای شما پیامک شد. لطفا در کادر زیر وارد کنید.'], 200);
                } else {
                    return $sms;
                }
            }
        } catch (\Exception $exception) {
            return $exception;
        }

    }

    public function sendSms(Request $request)
    {
        try {
            $api = new \Kavenegar\KavenegarApi("4470686233536566795848666962306F59327335574D786772655075704668586C31415162524E717747413D");
            $sender = "10005989";
            $message = $request->message;
            $receptor = array($request->mobile);
            $result = $api->Send($sender, $receptor, $message);
            if ($result) {
                $info = [
                    "messageid" => $result->messageid,
                    "message" => $result->message,
                    "status" => $result->status,
                    "statustext" => $result->statustext,
                    "sender" => $result->sender,
                    "receptor" => $result->receptor,
                    "date" => $result->date,
                    "cost" => $result->cost
                ];

            }else{
                $info = $result;
            }
            return response($info, 200);

        } catch(\Exception $e){
            return $e;
        }
    }

    public function verifyMobile(Request $request)
    {
        try {
            $user = User::where('mobile', $request['mobile'])->first();
            if ($user->otp === $request['codemobile']) {
                return response(['message' => 'شماره موبایل با موفقیت تایید شد.'], 200);
            } else {
                return response(['message' => 'کد تایید وارد شده اشتباه است.'], 422);
            }
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function store(Request $request)
    {
        try {
            $user = User::create($request->all());
            return response($user, 201);
        } catch (\Exception $exception) {
            return $exception;
        }
    }


}
