@extends('layouts.admin.app')

@section('title')
  <title>Plans</title>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="pull-right">
            <a href="{{ route('admin.plans.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Add New Plan
            </a>
        </div>
        <h1>PLANS</h1>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
				            <th class="">ID</th>
				            <th class="">Name</th>
				            <th class="">Type</th>
				            <th class="">Price ($)</th>
				            <th class="">Period days</th>
				            <th class="">Trial days</th>
				            <th class="">Tags</th>
				            <th class="">Created At</th>
				            <th class="">Updated At</th>
				            <th class=""></th>
                        </tr>
                    </thead>
                    <tbody>
				    @foreach ($plans as $index => $plan)
				        <tr>
                            <td>{{ $plan->id }}</td>
				            <td>
				            	<span>{{ $plan->name }}</span>
				            </td>
				            <td>
				                <span>{{ $plan->type }}</span>
				            </td>
				            <td>
				                <span>{{ $plan->price_cents / 100 }}</span>
				            </td>
				            <td>
				                <span>{{ $plan->period_days }}</span>
				            </td>
				            <td>
				                <span>{{ $plan->trial_days }}</span>
				            </td>
				            <td>
				                <span>{{ implode('', $plan->tagNames()) }}</span>
				            </td>
				            <td>@datetime($plan->created_at)</td>
				            <td>@datetime($plan->updated_at)</td>
				            <td>
				                <a href="{{ route('admin.plans.edit', $plan->id) }}" class="btn btn-info">
				                	<i class="fa fa-pencil"></i>
				                </a>
			                    <a method="DELETE" href="{{ route('admin.plans.destroy', $plan->id) }}" data-confirm="Are you sure to delete?" class="btn btn-danger">
			                        <i class="fa fa-trash"></i>
			                    </a>
				            </td>
				        </tr>
				    @endforeach
				    </tbody>
				</table>
                {!! $plans->links() !!}
            </div>
        </div>
    </div>

@endsection
