<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

use App\Subtitle;

class SubtitlesController extends BaseController
{
    public function index()
    {
        $subtitles = Subtitle::orderBy('created_at', 'desc')->paginate(9);
        return $subtitles->toJson();
    }
}
