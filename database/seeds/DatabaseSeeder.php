<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(PlanTableSeeder::class);

        $this->call(AdminTableSeeder::class);
        $this->call(UserTableSeeder::class);
        
        $this->call(CategoryTableSeeder::class);
        $this->call(SeriesTableSeeder::class);
        $this->call(MovieTableSeeder::class);
        $this->call(PlayTableSeeder::class);
        $this->call(VideoTableSeeder::class);
        $this->call(SubtitleTableSeeder::class);
        $this->call(ImageTableSeeder::class);
        $this->call(ProductTableSeeder::class);

        $this->call(ReviewTableSeeder::class);
    }
}
