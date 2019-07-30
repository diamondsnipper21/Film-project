<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    const RESOLUTIONS = [
        '140p' => [256, 144], 
        '240p' => [426, 240], 
        '360p' => [640, 360], 
        '480p' => [854, 480], 
        '720p' => [1280, 720], 
        '1080p' => [1920, 1080], 
    ];

    const RESOLUTION_OPTIONS = ['140p', '240p', '360p', '480p', '720p', '1080p'];

    protected $fillable = ['name', 'duration'];

    protected $appends = ['subtitles', 'videos'];

    public function playable()
    {
        return $this->morphTo();
    }

    public function movie()
    {
        return $this->belongsTo('App\Movie');
    }

    public function videos()
    {
    	return $this->hasMany('App\Video');
    }

    public function video($quality)
    {
        return $this->videos()->where('quality', $quality)->first();
    }

    public function subtitles()
    {
    	return $this->hasMany('App\Subtitle');
    }

    public function featured_image()
    {
        if(is_null($this->videos))
            return null;
        return $this->videos()->first()->featured_image()->first();
    }

    public function featured_image_url()
    {
        if ($this->featured_image == null)
            return '';

        return $this->featured_image->url;
    }

    public function getSubtitlesAttribute()
    {
        return $this->subtitles()->get();
    }

    public function getVideosAttribute()
    {
        return $this->videos()->get();
    }

}
