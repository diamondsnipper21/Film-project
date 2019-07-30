<div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Products({!! count($category->products) !!})</h3>
            </div>
            <div class="panel-body">

                {!! Form::open(['id' => 'form-remove-products', 'route' => ['admin.categories.remove_products', $category->id], 'method' => 'delete', 'class' => 'form-horizontal']) !!}
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
                            <th class=""></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($category->products as $index => $product)
                        <tr>
                            <td>
                                <label for='checkbox{{ $product->id }}'>
                                    <input id='checkbox{{ $product->id }}' type='checkbox' name='product_ids[]' value='{{$product->id}}'/> {{ $index + 1 }}
                                </label>
                            </td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="thumbnail widget widget-hover-effect1">
                                    <img src="{{ $product->featured_image_url }}" alt="featured" />
                                </a>
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->year }}</td>
                            <td>{{ $product->make }}</td>
                            <td>{{ implode($product->tagNames(), ',') }}</td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-info">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a method="DELETE" href="{{ route('admin.categories.remove_product', [$category->id, $product->id]) }}" data-confirm="Are you sure to delete?" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan=8 class="text-center">
                                <a href="{{ route('admin.categories.products', $category->id) }}" data-toggle="tooltip" title="" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Add More Products
                                </a>
                                <button type="submit" form="form-remove-products" data-toggle="tooltip" title="" class="btn btn-danger">
                                    <i class="fa fa-trash"></i> Remove Selected Products
                                </button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                {!! Form::close() !!}

            </div>
        </div>
    </div>