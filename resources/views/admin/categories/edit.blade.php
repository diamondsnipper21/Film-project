@extends('layouts.admin.app')

@section('title')
  <title>{{ $category->name }}</title>
@endsection

@section('content')

    <div class="container-fluid">
        <h1>EDIT CATEGORY</h1>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> DETAIL</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div id="featured-image">
                            <a href="javascript:void(0)" class="widget widget-hover-effect1 bg-info thumbnail">
                                <img id="thumbnail-image" v-bind:src="item.url" alt="featured" class="pull-center">
                            </a>

                            <a href="javascript:void(0)" data-toggle="modal" data-target="#imageModal" title="Add" class="btn btn-success">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        {!! Form::open(['id' => 'form-category', 'route' => ['admin.categories.update', $category->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}

                            <div class="form-group">
                                {!! Form::label('name', 'Name:', ['class' => 'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('name', $category->name, ['class' => 'form-control', 'placeholder' => 'Name', 'requried']) !!}
                                </div>
                            </div>

                             <div class="form-group">
                                {!! Form::label('slug', 'Slug:', ['class' => 'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('slug', $category->slug, ['class' => 'form-control', 'placeholder' => 'Slug', 'requried', 'readonly']) !!}
                                </div>
                            </div>

                             <div class="form-group">
                                {!! Form::label('description', 'Description:', ['class' => 'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('description', $category->description, ['class' => 'form-control', 'placeholder' => 'Description', 'requried']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" form="form-category" data-toggle="tooltip" title="Save" class="btn  btn-primary">
                                        <i class="fa fa-save"> SAVE</i>
                                    </button>
                                    <a method="DELETE" href="{{ route('admin.categories.destroy', $category->id) }}" data-toggle="tooltip" title="delete" class="btn  btn-danger" data-confirm="Are you sure to delete this category?">
                                        <i class="fa fa-reply"> DELETE</i>
                                    </a>
                                </div>
                            </div>
                        {!! Form::close() !!}  
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! view('admin.categories._products', ['category' => $category]) !!}
    {!! view('admin.images.modal') !!}

    <script type="text/javascript">
        var API = require('api').default;
        var ImageList = require('components/ImageList');
        var category = {!! $category->toJSON() !!};

        var FeaturedImage = new Vue({
            el: '#featured-image',
                data: {
                item: category.featured_image,
            },
            methods: {
                update: function (image, e) {
                    $('.modal').modal('hide');
                    
                    API.categories.update_featured_image(category.id, image.id)
                        .then(function (res) {
                            return res.json();
                        })
                        .then(function (result) {
                             FeaturedImage.item = result;
                        });
                }
            }
        });

        ImageList.default.onImageSelected = FeaturedImage.update;

    </script>
@endsection
