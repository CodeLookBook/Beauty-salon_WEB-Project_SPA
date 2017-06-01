<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{

    public function isValid()
    {

        try {

            $isTokenValid = !!(JWTAuth::parseToken()->authenticate());

        } catch (JWTException $e) {

            $isTokenValid = false;

        }

        return response()->json(compact('isTokenValid'));

    }

}
