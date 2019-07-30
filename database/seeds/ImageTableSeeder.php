<?php

use Illuminate\Database\Seeder;
use App\Movie;
use App\Series;
use App\Video;
use App\Image;
use App\Actor;

class ImageTableSeeder extends Seeder
{
    public function run()
    {
    	factory('App\Image', 10)->create();
    }
}
