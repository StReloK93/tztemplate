<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Auth;
use Hash;
class UserService {

    public function login($request) {

        if (Auth::attempt($request->only('email', 'password'))) {

            $user = Auth::user();
            $token = $this->createToken($user);
            return response()->json(['token' => $token,'type' => 'Bearer'], 200);

        }

        return response()->json(['message' => 'Parol yoki email xato!'], 299);
    }

    private function createToken($user) {
        return $user->createToken('userToken', ['almighty'])->plainTextToken;
    }


    public function register($request) {

        $params = $request->only('email','name','password');
        $params['password'] = Hash::make($params['password']);
        $user = User::create($params);

        event(new Registered($user));
        return response()->json(true, 200);
    }

    public function getUser($request){
        return $request->user()->tokens;
    }


    public function logout($request): void {

        $user = $request->user();
        $user->currentAccessToken()->delete();

    }

}