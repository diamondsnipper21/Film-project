<?php

namespace App;

use App\Product;

class ProductObserver
{
    public function created(Product $product)
    {
        $product->update(['slug' => $this->get_slug($product->name)]);
    }

    // it should be replaced cvierbrock's Eloquent-Sluggable package
    public function get_slug($name) {
        $slug = str_slug($name);
        $slug_count = count( Product::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );
        return ($slug_count > 0) ? "{$slug}-{$slug_count}" : $slug;
    }
}