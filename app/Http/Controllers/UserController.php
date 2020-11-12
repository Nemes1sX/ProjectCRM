<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;

class UserController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
           'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $this->guard('api')->login($user);

        return response()->json(['status' => 'success'], 200);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token =  JWTAuth::attempt($credentials)) {

            return response()->json(['status' => 'success', 'token' => $token], 200)->header('Authorization', $token);
        }
        return response()->json(['error' => 'Login failed'], 401);


    }

    public function check(){
        if(Auth::guard('api')->check())
            return response()->json(['status' => 'User logged in'], 200);
    }

    public function refresh()
    {
        if($token = $this->guard('api')->refresh()){
            return response()
                ->json(['status' => 'success'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'Token refresh error'], 401);
    }

    public function logout()
    {
        $this->guard('api')->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out successfully'
        ], 200);
    }

}
}
