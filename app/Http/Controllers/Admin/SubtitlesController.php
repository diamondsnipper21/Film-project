<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subtitle;
use Storage;

class SubtitlesController extends AdminController
{

    public function index()
    {
        $subtitles = Subtitle::orderByDesc('created_at')->paginate(9);
        return view('admin/subtitles/index', ['subtitles' => $subtitles]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        foreach($request->file('file') as $file)
        {
            $subtitle = new Subtitle();

            $path = $file->store('subtitle');
            $subtitle->language = '??';
            $subtitle->url = '/files/'.$path;

            $subtitle->save();
        }

        return redirect(route('admin.subtitle.index'));
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
