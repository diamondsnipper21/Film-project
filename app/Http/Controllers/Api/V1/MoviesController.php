<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

use App\Series;
use App\Image;
use App\Movie;

class MoviesController extends BaseController
{
    public function index()
    {
        $movies = Movie::orderBy('created_at', 'desc')->paginate(9);
        return $movies->toJson();
    }

    public function add_image($movie_id, Request $request)
    {
    	$movie = Movie::find($movie_id);
    	$image = Image::find($request->image_id);

    	$movie->images()->save($image);

        return $movie->images->toJson();
    }

    public function remove_image($movie_id, Request $request)
    {
    	$movie = Movie::find($movie_id);
    	$image = Image::find($request->image_id);

    	$movie->images()->detach([$image->id]);

        $movie->save();

        return $movie->images->toJson();
    }

    public function update_featured_image($movie_id, Request $request)
    {
        $movie = Movie::find($movie_id);
        $image = Image::find($request->image_id);
        $movie->featured_image_id = $image->id;
        $movie->save();

        return $image->toJson();
    }

}
