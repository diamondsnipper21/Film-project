@extends('layouts.user.app')

@section('title')
    <title>Film User</title>
@endsection
       
@section('content')
    <div class="container-fluid">
        <h3>{{ $product->name }}</h3>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="javascript:void(0)" class="widget widget-hover-effect1 bg-info">
                                    <img id="thumbnail-image" src="{{ $product->featured_image_url }}" alt="featured" class="img-thumbnail pull-center">
                                </a>
                            </div>

                            <div class="col-sm-6">
                                <div class="block">
                                    <div class="row">
                                        <dl class="dl-horizontal">
                                            <dt>Year:</dt>
                                            <dd>{{ $product->year }}</dd>
                                            <dt>Make:</dt>
                                            <dd>{{ $product->make }}</dd>
                                            <dt>Tags:</dt>
                                            <dd>{{ $product->tags }}</dd>
                                        </dl>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <a href="{{ route('user.products.play', $product->id) }}" class="btn btn-primary btn-sm">Play</a>
                                            <a class="btn btn-warning btn-sm">Purchase</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#description">Description</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="description" class="tab-pane fade in active">
                                    <div class="col-sm-12">
                                        {{ $product->description }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
