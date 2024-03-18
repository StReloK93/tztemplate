<?php

namespace App\Services;

use Auth;
use App\Models\User;
use App\Models\SMSList;
class UserService
{

    public function login($request)
    {
        $user = User::updateOrCreate(['phone' => $request->phone]);
        if (Auth::loginUsingId($user->id)) {

            $user = Auth::user();
            $token = $this->createToken($user);
            return response()->json(['token' => $token, 'type' => 'Bearer'], 200);

        }

        return response()->json(['message' => 'Parol yoki email xato!'], 299);
    }

    public static function sendSecretCode($request)
    {
        $number = random_int(100000, 999999);
        $message = "Maxfiy kodni kiriting $number";
        // $data = EskizSmsService::sendSecretCode($request->phone, $message);
        // if ($data->status == "error") return response()->json(['message' => $data], 403);

        SMSList::create([
            'type' => 1,
            'phone' => $request->phone,
            'message' => $message,
            'code' => $number,
        ]);
        
        return response()->json(['message'=> 'success'], 200);
    }
    private function createToken($user)
    {
        return $user->createToken('userToken', ['almighty'])->plainTextToken;
    }

    public function getUser($request)
    {
        return $request->user()->tokens;
    }


    public function logout($request): void
    {

        $user = $request->user();
        $user->currentAccessToken()->delete();

    }

}