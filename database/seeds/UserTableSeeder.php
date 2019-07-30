<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Movie;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        factory('App\User', 10)->create();

        for ($i = 1; $i <= 3; $i ++)
        {
        	$user = new User;

        	$user->name = 'user'.$i;
        	$user->email = 'user'.$i.'@film.com';
        	$user->password = bcrypt('123');

        	$user->save();
        }

        $users = User::all();
        $movies = Movie::all()->take(3);

        foreach($users as $user)
        {
            $user->movies()->saveMany($movies);
        }
    }
}
