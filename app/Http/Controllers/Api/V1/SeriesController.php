<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

use App\Series;
use App\Image;
use App\Video;
use App\Movie;

class SeriesController extends BaseController
{
    public function add_movie($series_id, Request $request)
    {
        $series = Series::find($series_id);
        $movie = Movie::find($request->movie_id);

        $series->movies()->save($movie);

        return $series->movies->toJson();
    }

    public function add_image($series_id, Request $request)
    {
        $series = Series::find($series_id);
        $image = Image::find($request->image_id);

        $series->images()->save($image);

        if($series->featured_image == null)
        {
            $series->featured_image()->save($image);
        }

        return $series->images->toJson();
    }

    public function remove_image($series_id, Request $request)
    {
    	$series = Series::find($series_id);
    	$image = Image::find($request->image_id);

    	$series->images()->detach([$image->id]);

        return $series->images->toJson();
    }

    public function remove_movie($series_id, Request $request)
    {
        $series = Series::find($series_id);

        $series->movies()->find($request->movie_id)->series()->dissociate();

        $series->save();

        return $series->movies->toJson();
    }

    public function update_featured_image($series_id, Request $request)
    {
        $series = Series::find($series_id);
        $image = Image::find($request->image_id);

        $series->featured_image_id = $image->id;
        $series->save();

        return $image->toJson();
    }

}
