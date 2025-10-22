<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Collaboration;
use App\Models\Complane;
use App\Models\User;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function sendOtp(Request $request)
    {
        try {
            $user = User::where('mobile', $request['mobile'])->first();
            if ($user && $user->role === 'admin') {
                return response(['message' => 'این شماره موبایل قابل استفاده نیست. لطفا با شماره دیگری تلاش کنید.'], 422);
            }
            $code = rand(1001, 9999);
            $text = ' به کوپابی خوش آمدید.
        کد تایید شما:
        ' . $code;
            $sms = new Request([
                'mobile' => $request->mobile,
                'message' => $text,
            ]);

            $send = $this->sendSms($sms);
            Cache::put($request['mobile'], $code, 60);
//            return $send;
            if ($send->getStatusCode() === 200) {
                return response(['message' => 'کد تایید ارسال شد.'], 200);

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
            $code = Cache::get($request['mobile']);
            if ($code === $request['code']) {
                $user = User::where('mobile', $request['mobile'])->first();
                if (!$user) {
                    $fields = new Request([
                        'mobile' => $request['mobile'],
                        'type' => $request['type'],
                        'name' => $request['name'],
                        'email' => $request['email']//'city_id'
                    ]);
                    $user = $this->store($fields);
                }
                return response(['user'=>$user,'message' => 'شماره موبایل با موفقیت تایید شد.'], 200);
            } else {
                return response(['message' => 'کد وارد شده اشتباه است.'], 422);
            }
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function store(Request $request): Response
    {
        try {
            $user = User::create($request->all());
            return response($user, 201);
        } catch (\Exception $exception) {
            return $exception;
        }
    }


}
