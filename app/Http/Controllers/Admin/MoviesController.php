<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Movie;
use App\Image;
use App\Actor;
use App\Play;
use App\Product;

class MoviesController extends AdminController
{
    public function index()
    {
        $movies = Movie::orderByDesc('created_at')->paginate(9);
        return view('admin.movies.index', ['movies' => $movies]);
    }

    public function create()
    {
        return view('admin.movies.create');
    }

    public function store(Request $request)
    {
        $movie = new Movie();

        $movie->title = $request->title;
        $movie->description = $request->description;
        $movie->year = $request->year;
        $movie->make = $request->make;
        $movie->order = $request->order;

        $movie->save();

        return redirect(route('admin.movies.index'));
    }

    public function edit($id)
    {
        $movie = Movie::find($id);
        return view('admin/movies/edit', ['movie' => $movie]);
    }

    public function update($id, Request $request)
    {
        $movie = Movie::find($id);

        $movie->title = $request->title;
        $movie->description = $request->description;

        $movie->save();

        return redirect(route('admin.movies.index'));
    }

    public function destroy($id)
    {
        Movie::destroy($id);

        return redirect(route('admin.movies.index'));
    }

    public function publish_to_product($id)
    {
        $movie = Movie::find($id);

        $product = $movie->create_product();

        return redirect(route('admin.products.edit', $product->id));
    }

}
