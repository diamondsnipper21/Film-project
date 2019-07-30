@extends('layouts.admin.app')

@section('title')
    <title>Series</title>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="pull-right">
            <a href="{{ route('admin.series.create') }}" class="btn btn-primary">
                <i class="fa fa-plus">Add New Series</i>
            </a>
        </div>
        <h1>SERIES</h1>
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
                    @foreach ($seriess as $index => $series)
                        <tr class="product-@boolean_to_string($series->is_product())">
                            <td>{{ ($seriess->currentPage() - 1) * $seriess->perPage() + $index + 1 }}</td>
                            <td>
                                <a href="{{ route('admin.series.edit', $series->id) }}" class="thumbnail widget widget-hover-effect1">
                                    <img src="{{ $series->featured_image_url }}" alt="featured" />
                                </a>
                            </td>
                            <td>
                                <span>{{ $series->title }}</span>
                            </td>
                            <td>{{ $series->duration }}</td>
                            <td>@datetime($series->created_at)</td>
                            <td>@datetime($series->updated_at)</td>
                            <td>
                                <a href="{{ route('admin.series.edit', $series->id) }}" class="btn btn-info">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <br/>

                                <a method="DELETE" class="btn btn-danger" href="{{ route('admin.series.destroy', $series->id) }}" data-confirm="Are you sure to delete?">
                                    <i class="fa fa-trash"></i>
                                </a>

                            </td>
                            <td class="text-center">
                            @if (!$series->is_product())
                                <a href="{{ route('admin.series.publish_to_product', $series->id) }}" data-toggle="tooltip" title="" class="btn btn-success">
                                    Publish to Product
                                </a>
                            @else
                                <a href="{{ route('admin.products.edit', $series->product->id) }}" data-toggle="tooltip" title="" class="btn btn-warning">
                                    Edit Product
                                </a>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $seriess->links() !!}
            </div>
        </div>
    </div>

@endsection
