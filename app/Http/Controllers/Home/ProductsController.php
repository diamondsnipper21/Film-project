<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Category;
use App\Movie;
use App\Product;
use Illuminate\Support\Facades\Cache;

class ProductsController extends HomeController
{
    public function show($slug)
    {
    	$product = Product::where('slug', $slug)->first();
        return view( 'home.products.show', [ 'product' => $product ]);
    }
}
