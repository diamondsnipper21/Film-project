@extends('layouts.admin.app')

@section('title')
  <title>{{ $movie->title }}</title>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="pull-right">
            <button type="submit" form="form-movie" data-toggle="tooltip" title="Save" class="btn btn-primary">
                <i class="fa fa-save"> Save</i>
            </button>
            <a href="{{ route('admin.movies.index') }}" data-toggle="tooltip" title="Cancel" class="btn btn-warning">
                <i class="fa fa-reply"> Back</i>
            </a>
        </div>
        <h1>EDIT MOVIE</h1>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i>Detail</h3>
            </div>
            <div class="panel-body">
                <div class="col-sm-6">
                    <a href="javascript:void(0)" class="widget widget-hover-effect1 thumbnail bg-info">
                        <img id="thumbnail-image" src="{{ $movie->featured_image_url }}" alt="featured" class="img-thumbnail pull-center">
                    </a>
                </div>

                <div class="col-sm-6">
                {!! Form::open(['id' => 'form-movie', 'route' => ['admin.movies.update', $movie->id], 'method' => 'put', 'files' => true]) !!}
                    <div class="form-group">
                        {!! Form::label('title', 'Title:', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('title', $movie->title, ['class' => 'form-control', 'placeholder' => 'Title here', 'requried']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description:', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('description', $movie->description, ['class' => 'form-control', 'placeholder' => 'Description here', 'requried']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('year', 'Year:', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('year', $movie->year, ['class' => 'form-control', 'placeholder' => 'Year here', 'requried']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('', 'Watched:', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::label('', $movie->watched.' times', ['class' => 'control-label']) !!}
                        </div>
                    </div>

                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

     <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Images({!! count($movie->images) !!})</h3>
            </div>
            <div class="panel-body">
                <div id="thumbnailList"></div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Preview</h3>
                
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">

                            <video width="400" controls>
                                <source src="{{ count($movie->preview_play->videos) > 0 ? $movie->preview_play->videos->first()->url : '' }}" type="video/mp4">
                                Your browser does not support HTML5 video.
                            </video>

                            <a href="{{ route('admin.plays.edit', $movie->preview_play->id) }}" class="btn btn-primary btn-sm pull-right" >
                                <i class="fa fa-pencil">Edit Preview</i>
                            </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Play</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">

                            <video width="400" controls>
                                <source src="{{ count($movie->play->videos) > 0 ? $movie->preview_play->videos->first()->url : '' }}" type="video/mp4">
                                Your browser does not support HTML5 video.
                            </video>

                            <a href="{{ route('admin.plays.edit', $movie->play->id) }}" class="btn btn-primary btn-sm pull-right" >
                                <i class="fa fa-pencil">Edit Play</i>
                            </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

{!! view('admin.images.modal') !!}

@endsection

@section('script')

    <script type="text/javascript">
        var movie = {!! $movie->toJSON() !!};

        function load(){
            var Page = require('movies_edit');
            var pageObject = new Page.default();
            pageObject.init(movie);
        }

        load();

    </script>

@endsection


