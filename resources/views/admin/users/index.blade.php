@extends('layouts.admin.app')

@section('title')
  <title>Users</title>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="pull-right">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Add New User
            </a>
        </div>
        <h1>USERS</h1>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
				            <th class="">No</th>
				            <th class="">Name</th>
				            <th class="">Email</th>
				            <th class="">Created At</th>
				            <th class="">Updated At</th>
				            <th class=""></th>
                        </tr>
                    </thead>
                    <tbody>
				    @foreach ($users as $index => $user)
				        <tr>
                            <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
				            <td>
				            	<span>{{ $user->name }}</span>
				            </td>
				            <td>
				                <span>{{ $user->email }}</span>
				            </td>
				            <td>@datetime($user->created_at)</td>
				            <td>@datetime($user->updated_at)</td>
				            <td>
				                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info">
				                	<i class="fa fa-pencil"></i>
				                </a>
			                    <a method="DELETE" href="{{ route('admin.users.destroy', $user->id) }}" data-confirm="Are you sure to delete?" class="btn btn-danger">
			                        <i class="fa fa-trash"></i>
			                    </a>
				            </td>
				        </tr>
				    @endforeach
				    </tbody>
				</table>
                {!! $users->links() !!}
            </div>
        </div>
    </div>

@endsection
