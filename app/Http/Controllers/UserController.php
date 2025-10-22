<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Collaboration;
use App\Models\Complane;
use App\Models\User;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class UserController extends Controller
{
    public function sendOtp(Request $request)
    {
        try {
            $user = User::where('mobile', $request['mobile'])->first();
            if ($user && $user->role === 'admin') {
                return response(['message' => 'این شماره قابل استفاده نیست. لطفا با شماره دیگری تلاش کنید.'], 422);
            }
            if (!$user) {
//                $user = $this->store($request->all('mobile', 'type', 'name', 'email')); //'city_id'
                $user = null;
            }
            $code = rand(1001, 9999);
            $text = ' به کوپابی خوش آمدید.
        کد تایید شما:
        ' . $code;
            $sms = new Request([
                'mobile'  => $request->mobile,
                'message' => $text,
            ]);

            $send = $this->sendSms($sms);
//            return $send;
            if ($send->getStatusCode() === 200) {    //save code in db ....
                return response(['user' => $user, 'message' => 'کد تایید برای شما پیامک شد. لطفا در کادر زیر وارد کنید.'], 200);

            } else {
                return $send;
            }
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function sendSms(Request $request): Response
    {
        try {
            $api = new \Kavenegar\KavenegarApi("4470686233536566795848666962306F59327335574D786772655075704668586C31415162524E717747413D");
            $sender = "10005989";
            $message = $request['message'];
            $receptor = array($request['mobile']);
            $result = $api->Send($sender, $receptor, $message);
            if ($result) {
                $info = [
                    "messageid" => $result[0]->messageid,
                    "message" => $result[0]->message,
                    "status" => $result[0]->status,
                    "statustext" => $result[0]->statustext,
                    "sender" => $result[0]->sender,
                    "receptor" => $result[0]->receptor,
                    "date" => $result[0]->date,
                    "cost" => $result[0]->cost
                ];

            } else {
                $info = $result;
            }
            return response($info, 200);

        } catch (\Kavenegar\Exceptions\ApiException $e) {
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            return $e;
        } catch (\Kavenegar\Exceptions\HttpException $e) {
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
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
