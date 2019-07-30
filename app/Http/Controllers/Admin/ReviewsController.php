<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Review;
use App\Movie;
use App\User;

class ReviewsController extends AdminController
{
    public function index()
    {
    	$reviews = Review::orderByDesc('created_at')->paginate(10);
    	return view('admin.reviews.index', ['reviews' => $reviews]);
    }

    public function create()
    {
        return view('admin/reviews/create');
    }

    public function store(Request $request)
    {
        $review = new Review();
        $movie = Movie::where('title', $request->movie)->first();
        $user = User::where('name', $request->author)->first();
                
        if (!is_null($movie) && !is_null($user))
        {
        	$review->movie_id = $movie->id;
	        $review->user_id = $user->id;
	        $review->score = $request->rating;
	        $review->description = $request->text;
	        $review->approved = $request->status;
        	$review->save();
        }

        return redirect(route('admin.reviews.index'));
    }

    public function edit($id)
    {
        $review = Review::find($id);
        return view('admin.reviews.edit', ['review' => $review]);
    }

    public function update($id, Request $request)
    {
        $review = new Review();
        $movie = Movie::where('title', $request->movie)->first();
        $user = User::where('name', $request->author)->first();
                
        if (!is_null($movie) && !is_null($user))
        {
        	$review->movie_id = $movie->id;
	        $review->user_id = $user->id;
	        $review->score = $request->rating;
	        $review->description = $request->text;
	        $review->approved = $request->status;
        	$review->save();
        }
        
        return redirect(route('admin.reviews.index'));
    }

    public function destroy($id)
    {
        review::destroy($id);

        return redirect(route('admin.reviews.index'));
    }
}
