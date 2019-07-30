<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Providers\User\EloquentUserAdapter;
use Tymon\JWTAuth\JWTManager;
use Illuminate\Support\Facades\Cookie;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

        $this->middleware(function ($request, $next) {
        	$jwtAuth = app('tymon.jwt.auth');

            if(Auth::user() != null){
                $token = $jwtAuth->fromUser(Auth::user());
                Cookie::queue('token', $token, 24 * 60 * 60, '/admin');
            }
		    return $next($request);
		});
    }
}
