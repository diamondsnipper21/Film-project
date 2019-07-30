<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Review;

class ReviewTableSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();

        foreach ($products as $product)
        {
            $product->reviews()->saveMany(factory('App\Review', 3)->create());
        }
    }
}
