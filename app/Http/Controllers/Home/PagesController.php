<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Category;
use App\Movie;
use App\Product;
use Illuminate\Support\Facades\Cache;

class PagesController extends HomeController
{
    public function home()
    {
        $recent_products = Product::all()->sortByDesc('created_at')->take(4);
        $categories = Category::all();

       	return view('home.index',
                    [
                        'recent_products' => $recent_products, 
                        'categories'=>$categories,
                    ]);
    }

    public function show($page)
    {

        return view( 'home.pages.' .  $page, [] );
    }

}
