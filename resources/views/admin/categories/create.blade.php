@extends('layouts.admin.app')

@section('title')
    <title>Categories-add</title>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="pull-right">
            <button type="submit" form="form-category" data-toggle="tooltip" title="Save" class="btn btn-primary">
                <i class="fa fa-save"> Save</i>
            </button>
            <a href="{{ route('admin.categories.index') }}" data-toggle="tooltip" title="Cancel" class="btn btn-warning">
                <i class="fa fa-reply"> Back</i>
            </a>
        </div>
        <h1>NEW CATEGORY</h1>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Detail</h3>
            </div>
            <div class="panel-body">
            {!! Form::open(['id' => 'form-category', 'route' => ['admin.categories.store'], 'method' => 'post', 'class' => 'form-horizontal']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name', 'requried']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Description', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Description', 'rows' => '5']) !!}
                    </div>
                </div>

            {!! Form::close() !!} 
            </div>
        </div>
    </div>

@endsection
