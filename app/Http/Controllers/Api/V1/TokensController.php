<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Providers\User\EloquentUserAdapter;
use Tymon\JWTAuth\JWTManager;

class TokensController extends BaseController
{
 	public function store(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        	$user = Auth::user();
            $jwtAuth = app('tymon.jwt.auth');
            $token = $jwtAuth->fromUser($user);
        	return array("authorized" => true, "token" => $token);
        }else{
        	return array("authorized" => false);
        }
    }
}
