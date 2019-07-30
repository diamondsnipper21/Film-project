@extends('layouts.admin.app')

@section('title')
    <title>Plays</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="pull-right">
            <a href="{{ route('admin.plays.create') }}" class="btn btn-primary">
                <i class="fa fa-plus">Add Play</i>
            </a>
        </div>
        <h1>PLAYS</h1>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="">No</th>
                            <th class="col-sm-2">Thumbnail</th>
                            <th class="">Name</th>
                            <th class="">Type</th>
                            <th class="">Duration</th>
                            <th class="">Created At</th>
                            <th class="">Updated At</th>
                            <th class=""></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $num = 1; ?>
                    @foreach ($plays as $play)
                        <tr>
                            <td>{{ $num++ }}</td>
                            <td>
                                <a href="{{ route('admin.plays.edit', $play->id) }}" class="thumbnail widget widget-hover-effect1">
                                    <img src="{{ is_null($play->featured_image()) ? '' : $play->featured_image()->url }}" alt="featured" />
                                </a>
                            </td>
                            <td>{{ $play->name }}</td>
                            <td>
                                {{ is_null($play->series)? $play->playable_type.' Preview' : 'Series' }}
                            </td>
                            <td>{{ $play->duration }}</td>
                            <td>@datetime($play->created_at)</td>
                            <td>@datetime($play->updated_at)</td>
                            <td>
                                <a href="{{ route('admin.plays.edit', $play->id) }}" class="btn btn-info">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <br/>
                                <a method="DELETE" href="{{ route('admin.plays.destroy', $play->id) }}" data-confirm="Are you sure to delete?" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {!! $plays->links() !!}

            </div>
        </div>
    </div>

@endsection
