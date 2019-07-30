<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

use App\Image;

class ImagesController extends BaseController
{
    public function index()
    {
        $images = Image::orderBy('created_at', 'desc')->paginate(9);
        return $images->toJson();
    }
}
