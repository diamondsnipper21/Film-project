@extends('layouts.admin.app')

@section('title')
  <title>Movie-add</title>
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
        <h1>NEW MOVIE</h1>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Detail</h3>
            </div>
            <div class="panel-body">
            {!! Form::open(['id' => 'form-movie', 'route' => ['admin.movies.store'], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                <div class="form-group required">
                    {!! Form::label('title', 'Title:', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title here']) !!}
                    </div>
                </div>

                <div class="form-group required">
                    {!! Form::label('order', 'Order:', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('order', '', ['class' => 'form-control', 'placeholder' => 'Order here']) !!}
                    </div>
                </div>

                <div class="form-group required">
                    {!! Form::label('year', 'Year:', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('year', '', ['class' => 'form-control', 'placeholder' => 'Year here']) !!}
                    </div>
                </div>

                <div class="form-group required">
                    {!! Form::label('make', 'Make:', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('make', '', ['class' => 'form-control', 'placeholder' => 'Make here']) !!}
                    </div>
                </div>

                <div class="form-group required">
                    {!! Form::label('description', 'Description:', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::textarea('text', '', ['cols' => '60', 'rows' => '8', 'class' => 'form-control', 'placeholder' => 'Description here', 'requried']) !!}
                    </div>
                </div>
        	{!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
