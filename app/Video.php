<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use Storage;
use Illuminate\Filesystem\Filesystem;

use App\Play;

class Video extends Model
{
    protected $table = 'videos';

    protected $appends = ['featured_image', 'featured_image_url'];

    public function featured_image()
    {
        return $this->belongsTo('App\Image', 'featured_image_id');
    }

    public function featured_image_url()
    {
        if ($this->featured_image == null)
            return '';

        return $this->featured_image->url;
    }
    
    public function play()
    {
        return $this->belongsTo('App\Play');
    }

    public static function create_from_uploaded_file($file)
    {
        $filesystem = new Filesystem();

        $storage_path = Storage::disk('public')->getConfig()->get('url') . '/';
        $path = $file->store('videos', 'public');
        $file_path = $storage_path . $path;

        $video = new Video();
        $video->size = Storage::disk('public')->size($path);
        $video->url = $file_path;

        $ffmpeg = FFMpeg::create(array(
            'ffmpeg.binaries'  => config('ffmpeg.binaries'),
            'ffprobe.binaries' => config('ffprobe.binaries'),
            'timeout'          => 3600, // The timeout for the underlying process
            'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
        ));

        $videoFile = $ffmpeg->open($file_path);
        $videoProbe = $videoFile->getFFProbe();
        $videoFormat = $videoProbe->format($file_path);
        $videoStreams = $videoProbe->streams($file_path);
        $videoInfo = $videoStreams->videos()->first();

        $video->duration = $videoInfo->get('duration');
        $video->width = $videoInfo->get('width');
        $video->height = $videoInfo->get('height');
        $video->name = $filesystem->name($file->getClientOriginalName());
        $video->quality = Video::calculate_resolution($video->width, $video->height);

        $video->save();


        $image_path = 'images/' . $filesystem->name($path) . '.jpg';

        $frame = $videoFile->frame(TimeCode::fromSeconds($video->duration/2));
        $frame->save(storage_path('app/public/') . $image_path);
        

        $image = new Image();
        $image->size = Storage::disk('public')->size($path);
        $image->url = $storage_path . $image_path;

        $video->featured_image()->save($image);

        $video->save();

        return $video;
    }

    public function getFeaturedImageAttribute()
    {
        return $this->featured_image()->first();
    }

    public function getFeaturedImageUrlAttribute()
    {
        return $this->featured_image_url();
    }

    public static function calculate_resolution($width, $height)
    {
        $wid = max($width, $height);
        for($i = 0; $i < count(Play::RESOLUTION_OPTIONS); $i ++)
        {
            $wid1 = 0;
            if($i > 0)
                $wid1 = Play::RESOLUTIONS[Play::RESOLUTION_OPTIONS[$i-1]][0];
            $wid2 = Play::RESOLUTIONS[Play::RESOLUTION_OPTIONS[$i]][0];
            if($wid1 <= $wid && $wid <= $wid2)
            {
                return Play::RESOLUTION_OPTIONS[$i];
            }
        }
        return '?';
    }
}
