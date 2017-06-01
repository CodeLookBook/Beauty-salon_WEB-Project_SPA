<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\SignInRequest;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function signin(SignInRequest $request){

        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token =  JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Неверный логин или пароль пользователя'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'Тойкен небыл создан. Попробуйте еще раз.'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'), 200);

    }
}
