<?php

namespace App\Http\Controllers\Api\Front;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

use App\Movie;
use App\User;
use Storage;

class FavouriteController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $user_id = $request->user_id;
        $movie_id = $request->movie_id;
        $user = User::find($user_id);
        $result = [];
        if($request->AddOrRemove == 0)
        {
            $result['success'] = $user->movies()->detach($movie_id);                
        }
        else
        {
            $result['success'] = $user->movies()->attach($movie_id);       
        }
        $result['type'] = $request->AddOrRemove;
        return $result->toJson();
    }

}
