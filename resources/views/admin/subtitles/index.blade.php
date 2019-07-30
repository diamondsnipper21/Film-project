@extends('layouts.admin.app')

@section('title')
    <title>Subtitles</title>
@endsection

@section('content')

	<h2>SUBTITLES</h2>

	<div class="row">
		<div class="col-sm-12">
	    	{!! view('admin.subtitles.show') !!}
	    </div>
	</div>
	
@endsection

@section('script')
@endsection
