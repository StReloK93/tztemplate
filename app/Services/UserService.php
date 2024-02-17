<?php

namespace App\Services;

use Auth;
use App\Models\User;

class UserService
{

    public function login($request)
    {
        User::updateOrCreate(['phone' => $request->phone]);

        if (Auth::attempt($request->only('phone'))) {

            $user = Auth::user();
            $token = $this->createToken($user);
            return response()->json(['token' => $token, 'type' => 'Bearer'], 200);

        }

        return response()->json(['message' => 'Parol yoki email xato!'], 299);
    }

    public static function sendSecretCode($request)
    {
        $number = random_int(100000, 999999);
        $data = EskizSmsService::sendSecretCode($request->phone, "Maxfiy kodni kiriting $number");
        if ($data->status == "error")
            return response()->json(['message' => $data], 403);

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