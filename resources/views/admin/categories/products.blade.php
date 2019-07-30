@extends('layouts.admin.app')

@section('title')
  <title>{{ $category->name }}</title>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="pull-right">
            <a href="{{ route('admin.categories.edit', $category->id) }}" data-toggle="tooltip" title="Cancel" class="btn  btn-warning">
                <i class="fa fa-reply"> Back</i>
            </a>
        </div>
        <h1>ADD MORE PRODUCTS</h1>
    </div>

     <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Uncategorized Products({!! count($products) !!})</h3>
            </div>
            <div class="panel-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="">No</th>
                            <th class="col-sm-2">Featured Image</th>
                            <th class="">Name</th>
                            <th class="">Description</th>
                            <th class="">Year</th>
                            <th class="">Make</th>
                            <th class="">Tags</th>
                        </tr>
                    </thead>
                    <tbody>
                    {!! Form::open(['id' => 'form-category-products', 'route' => ['admin.categories.add_products', $category->id], 'method' => 'post', 'class' => 'form-horizontal']) !!}

                    @foreach ($products as $index => $product)
                        <tr>
                            <td class="col-sm-1">
                                <label for='checkbox{{ $product->id }}'>
                                    <input id='checkbox{{ $product->id }}' type='checkbox' name='product_ids[]' value='{{$product->id}}'/>
                                    {{ ($products->currentPage() - 1) * $products->perPage() + $index + 1 }}
                                </label>

                            </td>
                            <td>
                                <a href="javascript:void(0)" class="thumbnail widget widget-hover-effect1">
                                    <img src="{{ $product->featured_image_url }}" alt="featured" />
                                </a>
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->year }}</td>
                            <td>{{ $product->make }}</td>
                            <td>{{ implode($product->tagNames(), ',') }}</td>
                        </tr>
                    @endforeach

                    {!! Form::close() !!}
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan=8 class="text-center">
                                <button type="submit" form="form-category-products" data-toggle="tooltip" title="" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Add Selected Products To Category
                                </button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                {!! $products->links() !!}

            </div>
        </div>
    </div>

@endsection
