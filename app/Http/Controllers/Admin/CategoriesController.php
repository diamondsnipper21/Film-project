<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Underscore\Types\Arrays;
use App\Image;
use Storage;

class CategoriesController extends AdminController
{
    public function index()
    {
    	$categories = Category::orderBy('position', 'asc')->get();
    	return view('admin.categories.index', ['categories' => $categories ]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $category = new Category();

        $category->name = $request->name;
        $category->description = $request->description;

        $category->save();

        return redirect(route('admin.categories.index'));
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update($id, Request $request)
    {
        $category = Category::find($id);

        $category->name = $request->name;
        $category->description = $request->description;
 
        $category->save();

        return redirect(route('admin.categories.edit', $category->id));
    }

    public function destroy($id)
    {
        Category::destroy($id);

        return redirect(route('admin.categories.index'));
    }

    public function products($id)
    {
        $category = Category::find($id);

        $product_ids = array_pluck($category->products, 'id');
        $products = Product::whereNotIn('id', $product_ids)->paginate(9);

        return view('admin.categories.products', ['category' => $category, 'products' => $products]);
    }

    public function add_products($id, Request $request)
    {
        $category = Category::find($id);

        $category->products()->attach($request->product_ids);

        return redirect(route('admin.categories.edit', $id));
    }

    public function remove_product($id, Request $request)
    {
        $category = Category::find($id);
        $product_id = $request->product_id;

        $category->products()->detach($product_id);

        return redirect(route('admin.categories.edit', $id));
    }

    public function remove_products($id, Request $request)
    {
        $category = Category::find($id);

        $category->products()->detach($request->product_ids);

        return redirect(route('admin.categories.edit', $id));
    }
}
