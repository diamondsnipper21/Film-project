<?php

namespace App;

class SeriesObserver
{
    public function created(Series $series)
    {
        $series->preview_play()->save(new Play(['name' => $series->title]));
    }

    public function deleting(Series $series)
    {
        $series->preview_play()->destroy();
    }
}