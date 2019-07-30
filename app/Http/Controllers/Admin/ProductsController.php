<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Image;
use App\Actor;
use App\Play;

class ProductsController extends AdminController
{

    public function index()
    {
        $products = Product::orderByDesc('created_at')->paginate(9);
        return view('admin.products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $product = new Product();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->year = $request->year;
        $product->make = $request->make;
        $product->featured_image_id = 0;

        $product->save();

        return redirect(route('admin.products.edit', $product->id));
    }

    public function edit($id)
    {
        $product = Product::with('tagged')->find($id);
        return view('admin.products.edit', ['product' => $product]);
    }

    public function update($id, Request $request)
    {
        $product = Product::find($id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->year = $request->year;
        $product->make = $request->make;

        $product->save();

        return redirect(route('admin.products.edit', $product->id));
    }

    public function destroy($id)
    {
        Product::destroy($id);

        return redirect(route('admin.products.index'));
    }

    public function categories($id)
    {
        $product = Product::find($id);

        $category_ids = array_pluck($product->categories, 'id');
        $categories = Category::whereNotIn('id', $category_ids)->paginate(9);

        return view('admin/products/categories', ['product' => $product, 'categories' => $categories]);
    }

    public function add_categories($id, Request $request)
    {
        $product = Product::find($id);

        $product->categories()->attach($request->category_ids);

        return redirect(route('admin.products.edit', $id));
    }

    public function remove_category($id, Request $request)
    {
        $product = Product::find($id);
        $category_id = $request->category_id;

        $product->categories()->detach($category_id);

        return redirect(route('admin.products.edit', $id));
    }

    public function remove_categories($id, Request $request)
    {
        $product = Product::find($id);

        $product->categories()->detach($request->category_ids);

        return redirect(route('admin.products.edit', $id));
    }
}
