<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtitle extends Model
{
    protected $table = 'subtitles';

    public function play()
    {
    	return $this->belongsTo('App\Play');
    }

}
