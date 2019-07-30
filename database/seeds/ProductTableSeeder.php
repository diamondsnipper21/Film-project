<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Product;
use App\Series;
use App\Movie;

class ProductTableSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();

        $series_array = Series::all()->shuffle();
        $movie_array = Movie::all()->shuffle();

        foreach($categories as $index => $category)
        {
            $seriess = $series_array->slice($index*2, 2);

            foreach ($seriess as $series)
            {
                $category->products()->attach($series->create_product());
            }


            $movies = $movie_array->slice($index*2, 2);

            foreach ($movies as $movie)
            {
                $category->products()->attach($movie->create_product());
            }
        }

    }
}
