<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Movie;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends UserController
{
    
    public function show($slug, Request $request)
    {
    	$category = Category::where('slug', $slug)->first();

    	$year = 'all';
    	$sort_by = 'name';
    	$sort_order = 'asc';

    	if (isset($request->year))
    	{
    		$year = $request->year;	
    	}

    	if (isset($request->sort_by))
    	{
    		$sort_by = $request->sort_by;	
    	}

    	if (isset($request->sort_order))
    	{
 			if ($request->sort_order == 'asc')

    			$sort_order = 'dsc';
    		else
    			$sort_order = 'asc';
    	}

    	$products = $category->products();
    	if($year != 'all')
		{
			$products = $products->where('year', $year);
		}

		$products = $products->orderBy($sort_by, $sort_order)->get();

        return view('user.categories.show', 
        			[
        				'category' => $category,
        			 	'products' => $products,
        			 	'sort_order' => $sort_order,
        			 	'sort_by' => $sort_by,
        			 	'year' => $year,
        			 ]
        );
    }
}
