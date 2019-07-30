<?php

use Illuminate\Database\Seeder;
use App\Movie;
use App\Series;

class SeriesTableSeeder extends Seeder
{
    public function run()
    {
        factory('App\Series', 9)->create();

        $seriess = Series::all();

        foreach($seriess as $series)
            $series->movies()->saveMany(factory('App\Movie', 2)->create());

        foreach ($seriess as $series)
        {
            $series->images()->saveMany(factory('App\Image', 2)->create());
            $series->featured_image_id = $series->images->first()->id;

            $series->save();
        }

    }
}
