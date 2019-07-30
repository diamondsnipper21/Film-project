<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        $categories = factory('App\Category', 8)->create();

        foreach ($categories as $category)
        {
        	$image = factory('App\Image')->create();
            $category->update(['featured_image_id' => $image->id]);
        }
    }
}
