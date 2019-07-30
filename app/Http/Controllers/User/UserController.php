<?php

namespace App\Http\Controllers\User;

use App\Category;
use App\Movie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');

        $this->middleware(function ($request, $next) {

	    	Cache::remember('categories', 60 * 24, function () {
    			return Category::all();
			});

		    return $next($request);
		});
    }
}
