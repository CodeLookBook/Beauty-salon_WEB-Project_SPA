<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user = JWTAuth::parseToken()->authenticate();

        if($user){
            if($user->role->name == 'admin'){

                return $next($request);

            } else {

                return response()->json(['message'=>'You must '.
                    'have an admin access rights'], 403);

            }
        } else {

            return response()->json(['message'=>'You are not signedup. '.
            'Contact with your administrator to be signup'], 401);

        }

    }
}
