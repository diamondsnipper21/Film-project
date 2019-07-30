@extends('layouts.admin.app')

@section('title')
    <title>Images</title>
@endsection

@section('content')

	<h2>IMAGES</h2>

	<div class="row">
		<div class="col-sm-12">
	    	{!! view('admin.images.show') !!}
	    </div>
	</div>

@endsection
