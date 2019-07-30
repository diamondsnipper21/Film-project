<?php

use Illuminate\Database\Seeder;
use App\Video;

class VideoTableSeeder extends Seeder
{
    public function run()
    {
    	factory('App\Video', 3)->create();

        $videos = Video::all();

        foreach ($videos as $video)
        {
        	$image = factory('App\Image')->create();
        	$video->featured_image_id = $image->id;
            $video->save();
        }
    }
}
