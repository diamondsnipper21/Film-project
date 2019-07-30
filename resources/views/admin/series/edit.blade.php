@extends('layouts.admin.app')

@section('title')
  <title>{{ $series->title }}</title>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="pull-right">
            <button type="submit" form="form-series" data-toggle="tooltip" title="Save" class="btn btn-sm btn-primary">
                <i class="fa fa-save"> Save</i>
            </button>
            <a href="{{ route('admin.series.index') }}" data-toggle="tooltip" title="Cancel" class="btn btn-sm btn-warning">
                <i class="fa fa-reply"> Back</i>
            </a>
        </div>
        <h1>EDIT SERIES</h1>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i>Detail</h3>
            </div>
            <div class="panel-body">
                <div class="row">

                    <div class="col-sm-6">
                        <a href="javascript:void(0)" class="widget widget-hover-effect1 thumbnail bg-info">
                            <img id="thumbnail-image" src="{{ $series->featured_image_url }}" alt="featured" class="img-thumbnail pull-center">
                        </a>
                    </div>

                    <div class="col-sm-6">
                    {!! Form::open(['id' => 'form-series', 'route' => ['admin.series.update', $series->id], 'method' => 'put', 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('title', 'Title:', ['class' => 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('title', $series->title, ['class' => 'form-control', 'placeholder' => 'Title here', 'requried']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description:', ['class' => 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('description', $series->description, ['class' => 'form-control', 'placeholder' => 'Description here', 'requried']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('year', 'Year:', ['class' => 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('year', $series->year, ['class' => 'form-control', 'placeholder' => 'Year here', 'requried']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('', 'Watched:', ['class' => 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::label('', $series->watched.' times', ['class' => 'control-label']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Images({!! count($series->images) !!})</h3>
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
                                <source src="{{ count($series->preview_play->videos) > 0 ? $series->preview_play->videos->first()->url : '' }}" type="video/mp4">
                                Your browser does not support HTML5 video.
                            </video>
                            
                            <a href="{{ route('admin.plays.edit', $series->preview_play->id) }}" class="btn btn-primary btn-sm pull-right" >
                                <i class="fa fa-pencil">Edit Preview</i>
                            </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Movies({!! count($series->movies) !!})</h3>
            </div>
            <div class="panel-body">
                <div id="movies"></div>
            </div>
        </div>
    </div>

{!! view('admin.images.modal') !!}
{!! view('admin.movies.modal') !!}

@endsection

@section('script')

    <script type="text/javascript">

        var series = {!! $series->toJSON() !!};

        function load(){
            var Page = require('series_edit');
            var pageObject = new Page.default();
            pageObject.init(series);
        }

        load();

    </script>

@endsection
