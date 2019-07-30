@extends('layouts.admin.app')

@section('title')
    <title>Videos</title>
@endsection

@section('content')
	<h2>VIDEOS</h2>

	<div class="row">
		<div class="col-sm-12">
		    {!! view('admin.videos.show') !!}
	    </div>
	</div>

    {!! view('admin.videos.player') !!}

@endsection
