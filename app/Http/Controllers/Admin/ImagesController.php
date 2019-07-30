<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Image;
use Storage;

class ImagesController extends AdminController
{
    public function index()
    {
        $images = Image::all();
        return view('admin/images/index', ['images' => $images]);
    }

    public function create()
    {
        return view('admin/images/create');
    }

    public function store(Request $request)
    {
        foreach($request->file('file') as $file)
        {
            Image::create_from_uploaded_file($file);
        }

        return redirect(route('admin.images.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
