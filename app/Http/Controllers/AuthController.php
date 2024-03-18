<?php
namespace App\Http\Controllers;


use App\Http\Requests\PhoneRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private UserService $service;
    
    public function __construct (UserService $service) {

        $this->service = $service;

    }


    public function sendSecretCode(PhoneRequest $request)
    {
        return $this->service->sendSecretCode($request);
    }
    public function Login(PhoneRequest $request)
    {

        return $this->service->login($request);
    
    }

    public function logout(Request $request)
    {
        
        return $this->service->logout($request);

    }

    public function getUser(Request $request){
 
        return $this->service->getUser($request);

    }

    public function logoutUser(Request $request){
        return $this->service->logout($request);
    }

}
