<?php
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\PagesController;
use App\Category;
use App\Movie;
use App\User;
use App\Product;

use Illuminate\Support\Facades\Auth;

class CategoriesController extends HomeController
{
    public function show($slug, Request $request)
    {

    	$category = Category::where('slug', $slug)->first();
    	$products = $category->products()->orderBy('created_at', 'desc')->paginate(10);
        $years = Product::years();
        $tags = Product::existingTags();

	    return view('home.categories.show', [
            'products'        => $products,
            'category'  => $category,
            'years' => $years,
            'tags' => $tags,
        ]);
	}
}
