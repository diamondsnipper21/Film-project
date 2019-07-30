<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 3; $i ++)
        {
            $admin = new Admin;

            $admin->name = 'admin'.$i;
            $admin->email = 'admin'.$i.'@film.com';
            $admin->password = bcrypt('123');

            $admin->save();
        }
    }
}
