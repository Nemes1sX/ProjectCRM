<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\TestRequest;
use App\User;

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class ExtensionController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token =  JWTAuth::attempt($credentials)) {

            return response()->json(['status' => 'success', 'token' => $token], 200)->header('Authorization', $token);
        }
        return response()->json(['error' => 'Login failed'], 401);



    }


    public function uploadImage(ImageRequest $request)
    {

        $imagedata = str_replace(['data:image/jpeg;base64','data:image/png;base64'], '', $request->input('image'));

        $imagedata = str_replace('', '+', $imagedata);

        $imagedata = base64_decode($imagedata);

        $source = imagecreatefromstring($imagedata);

        $rotate = imagerotate($source, 0, 0);

        $imagename = storage_path('app/screenshots/') . time() . '.jpg';

        imagejpeg($rotate, $imagename, 100);

        return response()->json(['status' => 'success'], 200);
    }

    public function user(Request $request){
        $user = User::find(Auth::user()->id);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 200);
    }


    public function postdata(TestRequest $request){
        return response()->json(['status' => 'success', 'message' => $request->input('text')], 200);
    }

    public function check(){
        if(Auth::guard('api')->check())
            return response()->json(['status' => 'User logged in'], 200);
    }

    public function test(){
        return response()->json(['status' => 'success', 'message' => 'Hello World'], 200);
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
