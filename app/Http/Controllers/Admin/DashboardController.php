<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Providers\User\EloquentUserAdapter;
use Tymon\JWTAuth\JWTManager;

use App\Category;
use App\Product;
use App\User;

class DashboardController extends AdminController
{
    public function index()
    {
        $categories_count = Category::count();
        $products_count = Product::count();
        $users_count = User::count();

		$data = [
			'categories_count' => $categories_count, 
			'products_count' => $products_count,
            'users_count' => $users_count,
		];

        return view('admin/dashboard/show', $data);
    }
}
