<?php

namespace App;

use App\Movie;

class MovieObserver
{
    public function created(Movie $movie)
    {
        $movie->preview_play()->save(new Play(['name' => $movie->title]));
        $movie->play()->save(new Play(['name' => $movie->title]));
    }

    public function deleting(Movie $movie)
    {
        Play::destroy($movie->preview_play->id);
        Play::destroy($movie->play->id);
    }

}