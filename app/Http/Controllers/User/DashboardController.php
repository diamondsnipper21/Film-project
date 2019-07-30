<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Movie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends UserController
{
    
    public function show()
    {
    	$categories = Category::all();
        return view('user/dashboard/show', ['current_selection' => 'dashboard', 
        									'categories' => $categories]) ;
    }
}
