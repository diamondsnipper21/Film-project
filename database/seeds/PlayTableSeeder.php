<?php

use Illuminate\Database\Seeder;
use App\Play;

class PlayTableSeeder extends Seeder
{
    public function run()
    {
        $plays = Play::all();

        foreach ($plays as $play)
        {
            $play->videos()->saveMany(factory('App\Video', 2)->create());
            $play->subtitles()->saveMany(factory('App\Subtitle', 2)->create());
        }
    }
}
