@extends('layouts.admin.app')

@section('title')
    <title>Products</title>
@endsection

@section('content')
    <div class="container-fluid">
        <h1>PRODUCTS</h1>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="">No</th>
                            <th class="col-sm-2">Featured Image</th>
                            <th class="">Name</th>
                            <th class="">Category</th>
                            <th class="">Description</th>
                            <th class="">Year</th>
                            <th class="">Make</th>
                            <th class="">Tags</th>
                            <th class=""></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $index => $product)
                        <tr class="product-{{$product->type()}}">
                            <td>{{ ($products->currentPage() - 1) * $products->perPage() + $index + 1 }}</td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="thumbnail widget widget-hover-effect1">
                                    <img src="{{ $product->featured_image_url }}" alt="featured" />
                                </a>
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->formatted_category_names() }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->year }}</td>
                            <td>{{ $product->make }}</td>
                            <td>{{ implode($product->tagNames(), ', ') }}</td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-info">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a method="DELETE" href="{{ route('admin.products.destroy', $product->id) }}" data-confirm="Are you sure to delete?" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {!! $products->links() !!}

            </div>
        </div>
    </div>

@endsection
