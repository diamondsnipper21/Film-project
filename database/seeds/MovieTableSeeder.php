<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\User;
use App\Movie;

class MovieTableSeeder extends Seeder
{
    public function run()
    {
        factory('App\Movie', 3)->create();

        $movies = Movie::all();

        foreach ($movies as $movie)
        {
            $movie->images()->saveMany(factory('App\Image', 2)->create());
            $movie->featured_image_id = $movie->images->first()->id;

            $movie->save();
        }

    }
}
