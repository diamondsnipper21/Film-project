@extends('layouts.admin.app')

@section('title')
    <title>Movies</title>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="pull-right">
            <a href="{{ route('admin.movies.create') }}" class="btn btn-primary">
                <i class="fa fa-plus">Add New Movie</i>
            </a>
        </div>
        <h1>MOVIES</h1>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="">No</th>
                            <th class="col-sm-2">Featured Image</th>
                            <th class="">Title</th>
                            <th class="">Duration</th>
                            <th class="">Created At</th>
                            <th class="">Updated At</th>
                            <th class=""></th>
                            <th class=""></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($movies as $index => $movie)
                        <tr class="product-@boolean_to_string($movie->is_product())">
                            <td>{{ ($movies->currentPage() - 1) * $movies->perPage() + $index + 1 }}</td>
                            <td>
                                <a href="{{ route('admin.movies.edit', $movie->id) }}" class="thumbnail widget widget-hover-effect1">
                                    <img src="{{ $movie->featured_image_url }}" alt="featured" />
                                </a>
                            </td>
                            <td>{{ $movie->title }}</td>
                            <td>{{ $movie->duration }}</td>
                            <td>@datetime($movie->created_at)</td>
                            <td>@datetime($movie->updated_at)</td>
                            <td>
                                <a href="{{ route('admin.movies.edit', $movie->id) }}" class="btn btn-info">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <br/>
                                <a method="DELETE" href="{{ route('admin.movies.destroy', $movie->id) }}" data-confirm="Are you sure to delete?" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                            <td class="text-center">
                            @if (!$movie->is_product())
                                <a href="{{ route('admin.movies.publish_to_product', $movie->id) }}" data-toggle="tooltip" title="" class="btn btn-success">
                                    Publish to Product
                                </a>
                            @else
                                <a href="{{ route('admin.products.edit', $movie->product->id) }}" data-toggle="tooltip" title="" class="btn btn-warning">
                                    Edit Product
                                </a>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $movies->links() !!}

            </div>
        </div>
    </div>

@endsection
