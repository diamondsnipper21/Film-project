@extends('layouts.admin.app')

@section('title')
  <title>{{ $product->slug }}</title>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="pull-right">
            <a href="{{ route('admin.products.index') }}" data-toggle="tooltip" title="Cancel" class="btn btn-warning">
                <i class="fa fa-reply"> Back</i>
            </a>
        </div>
        <h1>EDIT {{ $product->productable_type=='App\\Series'?'SERIES':'MOVIE' }} PRODUCT</h1>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i>Detail</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="javascript:void(0)" class="widget widget-hover-effect1 bg-info thumbnail">
                            <img id="thumbnail-image" src="{{ $product->featured_image_url }}" alt="featured" class="pull-center">
                        </a>
                    </div>

                    <div class="col-sm-6">
                    {!! Form::open(['id' => 'form-product', 'route' => ['admin.products.update', $product->id], 'method' => 'put', 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Name:', ['class' => 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('name', $product->name, ['class' => 'form-control', 'placeholder' => 'Title here', 'requried']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug:', ['class' => 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('slug', $product->slug, ['class' => 'form-control', 'placeholder' => 'Title here', 'readonly']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description:', ['class' => 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('description', $product->description, ['class' => 'form-control', 'placeholder' => 'Description here', 'requried']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('year', 'Year:', ['class' => 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('year', $product->year, ['class' => 'form-control', 'placeholder' => 'Year here', 'requried']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('make', 'Make:', ['class' => 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('make', $product->make, ['class' => 'form-control', 'placeholder' => 'Make here', 'requried']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('', '', ['class' => 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                <button type="submit" title="Save" class="btn btn-primary">
                                    <i class="fa fa-save"></i> SAVE
                                </button>
                            </div>
                        </div>
                        
                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Images({!! count($product->images) !!})</h3>
                    </div>
                    <div class="panel-body">
                        <div id="thumbnailList"></div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                {!! view('admin.products._categories', ['product' => $product]) !!}
                {!! view('admin.products._tags', ['product' => $product]) !!}
                {!! view('admin.products._plans', ['product' => $product]) !!}
            </div>
    
        </div>
    </div>

{!! view('admin.images.modal') !!}

@endsection

@section('script')

    <script type="text/javascript">
        var product = {!! $product->toJSON() !!};

        function load(){
            var Page = require('products_edit');
            var pageObject = new Page.default();
            pageObject.init(product);
        }

        load();

    </script>

@endsection


