@extends('layouts.admin.app')

@section('title')
  <title>User-edit</title>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="pull-right">
            <button type="submit" form="form-user" data-toggle="tooltip" title="Save" class="btn btn-primary">
                <i class="fa fa-save"> Save</i>
            </button>
            <a href="{{ route('admin.users.index') }}" data-toggle="tooltip" title="Cancel" class="btn btn-warning">
                <i class="fa fa-reply"> Back</i>
            </a>
        </div>
        <h1>EDIT USER</h1>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i>Detail</h3>
            </div>
            <div class="panel-body">
            {!! Form::open(['id' => 'form-user', 'route' => ['admin.users.update', $user->id], 'method' => 'put', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name:', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Name here', 'requried']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email:', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Email here', 'requried']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('old-password', 'Old Password:', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::password('old-password', ['class' => 'form-control', 'placeholder' => 'old password here', 'requried']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('new-password', 'New Password:', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::password('new-password', ['class' => 'form-control', 'placeholder' => 'new password here', 'requried']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('confirm-password', 'Confirm New Password:', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::password('confirm-password', ['class' => 'form-control', 'placeholder' => 'type password again', 'requried']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
