<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Series;
use App\Play;
use App\Product;

class SeriesController extends AdminController
{

    public function index()
    {
        $seriess = Series::orderByDesc('created_at')->paginate(9);
        return view('admin.series.index', ['seriess' => $seriess]);
    }

    public function create()
    {
        return view('admin.series.create');
    }

    public function store(Request $request)
    {
        $series = new Series();

        $series->title = $request->title;
        $series->description = $request->description;
        $series->year = $request->year;
        $series->make = $request->make;

        $series->save();

        return redirect(route('admin.series.index'));
    }

    public function show(Series $series)
    {
        //
    }

    public function edit($id)
    {
        $series = Series::find($id);
        return view('admin/series/edit', ['series' => $series]);
    }

    public function update($id, Request $request)
    {
        $series = Series::find($id);

        $series->title = $request->title;
        $series->description = $request->description;
        $series->year = $request->year;
        $series->make = $request->make;

        $series->save();

        return redirect(route('admin.series.index'));
    }

    public function destroy(Series $series)
    {
        //
    }

    public function publish_to_product($id)
    {
        $series = Series::find($id);

        $product = $series->create_product();

        return redirect(route('admin.products.edit', $product->id));
    }

}
