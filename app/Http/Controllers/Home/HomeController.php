<?php

namespace App\Http\Controllers\Home;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Category;
use Cache;

class HomeController extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	function __construct()
	{
    	Cache::remember('categories', 60 * 24, function () {
    		return Category::withCount('products')->get()->reject(
                function ($category) {
                    return $category->products_count == 0;
                });
		});
	}
}
