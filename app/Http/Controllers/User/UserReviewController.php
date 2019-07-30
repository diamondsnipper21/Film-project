<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Movie;
use Illuminate\Support\Facades\Auth;

function distanceOfTimeInWords($fromTime, $toTime)
{
    $distanceInSeconds = round(abs($toTime - $fromTime));
    $distanceInMinutes = round($distanceInSeconds / 60);
    
    if ( $distanceInMinutes <= 1 ) {
        if ( !$showLessThanAMinute ) {
            return ($distanceInMinutes == 0) ? 'less than a minute' : '1 minute';
        } else {
            if ( $distanceInSeconds < 5 ) {
                return 'less than 5 seconds';
            }
            if ( $distanceInSeconds < 10 ) {
                return 'less than 10 seconds';
            }
            if ( $distanceInSeconds < 20 ) {
                return 'less than 20 seconds';
            }
            if ( $distanceInSeconds < 40 ) {
                return 'about half a minute';
            }
            if ( $distanceInSeconds < 60 ) {
                return 'less than a minute';
            }
            
            return '1 minute';
        }
    }
    if ( $distanceInMinutes < 45 ) {
        return $distanceInMinutes . ' minutes';
    }
    if ( $distanceInMinutes < 90 ) {
        return 'about 1 hour';
    }
    if ( $distanceInMinutes < 1440 ) {
        return 'about ' . round(floatval($distanceInMinutes) / 60.0) . ' hours';
    }
    if ( $distanceInMinutes < 2880 ) {
        return '1 day';
    }
    if ( $distanceInMinutes < 43200 ) {
        return 'about ' . round(floatval($distanceInMinutes) / 1440) . ' days';
    }
    if ( $distanceInMinutes < 86400 ) {
        return 'about 1 month';
    }
    if ( $distanceInMinutes < 525600 ) {
        return round(floatval($distanceInMinutes) / 43200) . ' months';
    }
    if ( $distanceInMinutes < 1051199 ) {
        return 'about 1 year';
    }
    
    return 'over ' . round(floatval($distanceInMinutes) / 525600) . ' years';
}

class UserReviewController extends UserController
{
    //
    public function show()
    {
    	$reviews = User::find(Auth::user()->id)->reviews;
    	$reviews_data = [];
    	foreach ($reviews as $review) {
    		$review['movie_name'] = Movie::find($review->movie_id)->title;
    		$review['time'] = distanceOfTimeInWords(strtotime($review->updated_at), time()) . ' ago';
    		array_push($reviews_data, $review);
    	}
    	return view('user/reviews/show', ['user' => Auth::user(), 'reviews' => $reviews_data, 'current_selection'=>'reviews']) ;
    }

    public function update(Request $request)
    {
    	$id = Auth::user()->id;
    	$user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;        
        $user->subscription = ($request->subscription == "on")?1:0;

        if (!is_null($request->new_password))
        {
            $user->password = bcrypt($request->new_password);
        }

        $success = $user->save();
        return view('user/information/show', ['user' => Auth::user(), 'current_selection'=>'information', 'success' => $success]) ;
    }
}
