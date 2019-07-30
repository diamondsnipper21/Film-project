<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

use App\Product;
use App\Image;
use App\Category;
use App\Plan;

class ProductsController extends BaseController
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(9);
        return $products->toJson();
    }

    public function add_image($id, Request $request)
    {
    	$product = Product::find($id);
    	$image = Image::find($request->image_id);

    	$product->images()->save($image);

        return $product->images->toJson();
    }

    public function remove_image($id, Request $request)
    {
    	$product = Product::find($id);
    	$image = $product->images->find($request->image_id);

    	$product->images()->detach([$image->id]);
        $product->save();

        return $product->images->toJson();
    }

    public function untag($id, Request $request)
    {
        $product = Product::find($id);
        $product->untag($request->tag);

        return $product->tags->toJson();
    }

    public function tag($id, Request $request)
    {
        $product = Product::find($id);
        
        if(isset($request->tag))
        {
            $product->tag($request->tag);
        }
        
        return $product->tags->toJson();
    }

    public function update_featured_image($id, Request $request)
    {
        $product = Product::find($id);
        $image = Image::find($request->image_id);

        $product->featured_image_id = $image->id;

        $product->save();
        
        return $image->toJson();
    }

    public function add_category($id, Request $request)
    {
        $product = Product::find($id);
        $category = Category::where('slug', $request->category)->first();
        
        $product->categories()->attach($category->id);

        return $product->categories->toJson();
    }

    public function remove_category($id, Request $request)
    {
        $product = Product::find($id);
        $category = Category::where('slug', $request->category)->first();

        $product->categories()->detach([$category->id]);

        return $product->categories->toJson();
    }

    public function add_tagged_plans($id, Request $request)
    {
        $product = Product::find($id);
        $plans = ProductPlan::withAllTags([$request->tag])->get();

        $product->plans()->syncWithoutDetaching($plans->pluck('id'));

        return $product->plans->toJson();
    }

    public function add_plan($id, Request $request)
    {
        $product = Product::find($id);
        $product->plans()->syncWithoutDetaching([$request->plan_id]);
        
        return $product->plans->toJson();
    }

    public function remove_plan($id, Request $request)
    {
        $product = Product::find($id);
        $product->plans()->detach([ $request->plan_id ]);

        return $product->plans->toJson();
    }
}
