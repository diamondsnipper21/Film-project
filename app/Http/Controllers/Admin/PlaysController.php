<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Play;

class PlaysController extends AdminController
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $play = Play::find($id);
        return view('admin/plays/edit', ['play' => $play]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function remove_video($id, $video_id)
    {
        $play = Play::find($id);

        $video = $play->videos()->find($video_id);        
        $video->play()->dissociate();

        $video->save();

        return redirect(route('admin.plays.edit', $id));
    }

}
