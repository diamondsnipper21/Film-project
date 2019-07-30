@extends('layouts.admin.app')

@section('title')
  <title>Users-add</title>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="pull-right">
            <button type="submit" form="form-review" data-toggle="tooltip" title="Save" class="btn btn-primary">
                <i class="fa fa-save"></i>
            </button>
            <a href="" data-toggle="tooltip" title="Cancel" class="btn btn-default">
                <i class="fa fa-reply"></i>
            </a>
        </div>
        <h1>Reviews</h1>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Add Review</h3>
            </div>
            <div class="panel-body">
            {!! Form::open(['id' => 'form-review', 'route' => ['admin.reviews.store'], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                <div class="form-group required">
                    {!! Form::label('author', 'Author', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('author', '', ['class' => 'form-control', 'placeholder' => 'Author', 'requried']) !!}
                    </div>
                </div>
                <div class="form-group required">
                    {!! Form::label('movie', 'Movie', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('movie', '', ['class' => 'form-control', 'placeholder' => 'Movie', 'requried']) !!}
                    </div>
                </div>
                <div class="form-group required">
                    {!! Form::label('text', 'Text', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::textarea('text', '', ['cols' => '60', 'rows' => '8', 'class' => 'form-control', 'placeholder' => 'Text', 'requried']) !!}
                    </div>
                </div>
                <div class="form-group required">
                    {!! Form::label('rating', 'Rating', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        <label class="radio-inline"><input type="radio" name="rating" value="1" checked="checked" />1</label>
                        <label class="radio-inline"><input type="radio" name="rating" value="2" />2</label>
                        <label class="radio-inline"><input type="radio" name="rating" value="3" />3</label>
                        <label class="radio-inline"><input type="radio" name="rating" value="4" />4</label>
                        <label class="radio-inline"><input type="radio" name="rating" value="5" />5</label>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('status', 'Status', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('status', ['1' => 'Enabled', '0' => 'Disabled'], '0', ['class' => 'form-control', 'requried']) !!}
                    </div>
                </div>
            {!! Form::close() !!} 
            </div>
        </div>
    </div>
@endsection
