<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

use App\Video;
use Storage;

class VideosController extends BaseController
{
    public function index(Request $request)
    {
    	$quality = $request->quality;

    	$videos = Video::with('featured_image');

    	if($quality != null && $quality != 'null')
    	{
    		$videos = $videos->where('quality', $quality);
    	}

        $videos = $videos->orderBy('created_at', 'desc')->paginate(9);

        return $videos->toJson();
    }

}
