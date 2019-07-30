<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

use App\Image;
use App\Video;
use App\Product;
use App\Category;

class CategoriesController extends BaseController
{
    public function add_product($category_id, Request $request)
    {
        $category = Category::find($category_id);
        $product = Product::find($request->product_id);

        $category->products()->attach($product);

        return $category->products->toJson();
    }

    public function remove_product($category_id, Request $request)
    {
        $category = Category::find($category_id);
        $product = Product::find($request->product_id);

        $category->products()->detach($product);

        return $category->products->toJson();
    }

    public function update_position($category_id, Request $request)
    {
        $category = Category::find($category_id);
        $target_category = Category::find($request->target_category_id);

        if($category->position < $target_category->position) {
            $category->moveAfter($target_category);
        } else {
            $category->moveBefore($target_category);
        }
        
        return Category::orderBy('position', 'asc')->get()->toJson();
    }

    public function update_featured_image($category_id, Request $request)
    {
        $category = Category::find($category_id);
        $image = Image::find($request->image_id);

        if($image) {
            $category->featured_image_id = $image->id;
            $category->save();
        }
        
        return $category->featured_image->toJson();
    }
}
