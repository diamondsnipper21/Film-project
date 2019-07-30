<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

use App\Play;
use App\Video;
use App\Subtitle;
use Storage;

class PlaysController extends BaseController
{
    public function add_or_update_video($play_id, Request $request)
    {
        $play = Play::find($play_id);
        $video = Video::find($request->video_id);

        if(!is_null($play->video($video->quality)))
        {
        	$old_video = $play->video($quality);
        	$old_video->play()->dissociate();
        	$old_video->save();
        }

    	$play->videos()->save($video);

        return $play->videos->toJson();
    }

    public function remove_video($play_id, Request $request)
    {
        $play = Play::find($play_id);
        $video = Video::find($request->video_id);

        $video->play()->dissociate();
        $video->save();

        return $play->videos->toJson();
    }

    public function add_subtitle($play_id, Request $request)
    {
        $play = Play::find($play_id);
        $subtitle = Subtitle::find($request->subtitle_id);

        $play->subtitles()->save($subtitle);

        return $play->subtitles->toJson();
    }

    public function remove_subtitle($play_id, Request $request)
    {
        $play = Play::find($play_id);
        $subtitle = Subtitle::find($request->subtitle_id);

        $subtitle->play()->dissociate();
        $subtitle->save();

        return $play->subtitles->toJson();
    }

}
