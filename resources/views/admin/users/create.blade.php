@extends('layouts.admin.app')

@section('title')
  <title>Users-add</title>
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
        <h1>NEW USER</h1>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Detail</h3>
            </div>
            <div class="panel-body">
            {!! Form::open(['id' => 'form-user', 'route' => ['admin.users.store'], 'method' => 'post']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name:', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name here', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email:', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email here', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('new-password', 'Password:', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::password('new-password', ['class' => 'form-control', 'placeholder' => 'password here', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('confirm-password', 'Confirm Password:', ['class' => 'control-label col-sm-2', 'required']) !!}
                    <div class="col-sm-10">
                        {!! Form::password('confirm-password', ['class' => 'form-control', 'placeholder' => 'password again']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#form-user').submit(function(){
                if($('#new-password').val() == $('#confirm-password').val())
                {
                    return true;
                }
                alert('password mismatch');
                return false;
            });
        });
    </script>
@endsection
