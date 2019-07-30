<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Movie;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends UserController
{
    
    public function show($id, Request $request)
    {

        $product = Product::find($id);
        
        return view('user.products.show', 
        			[
        			 	'product' => $product
        			 ]
        );
    }

    public function play($id)
    {
        $product = Product::find($id);

        return view('user.products.play', 
                    [
                        'product' => $product
                     ]
        );
    }
}
