<?php

use Illuminate\Database\Seeder;

class SubtitleTableSeeder extends Seeder
{
    public function run()
    {
        factory('App\Subtitle', 3)->create();
    }
}
