@extends('layouts.home.app')

@section('title')
  <title>KORFILM</title>
@endsection

@section('content')


 <!-- Home Carousel -->
<div id="home-carousel" class="carousel carousel-home slide" data-ride="carousel" data-interval="5000">
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        @foreach( Cache::get('categories') as $index => $category )
        <div class="item {{ $index==0?'active':''}}" style="background: url({{ $category->featured_image_url }}) center center;">
            <div class="hero-text">
                    <h1 class="text-center animation-slideDown hidden-xs"><strong>{{ $category->name }}</strong></h1>
                    <h2 class="text-center animation-slideUp push hidden-xs">{{ $category->description }}</h2>
            </div>

        </div>
        @endforeach
    </div>
    <!-- END Wrapper for slides -->

    <!-- Controls -->
    <a class="left carousel-control" href="#home-carousel" data-slide="prev">
        <span>
            <i class="fa fa-chevron-left"></i>
        </span>
    </a>
    <a class="right carousel-control" href="#home-carousel" data-slide="next">
        <span>
            <i class="fa fa-chevron-right"></i>
        </span>
    </a>
    <!-- END Controls -->
</div>


<!-- Products -->
<section class="site-content site-section">
    <div class="container">
        <h2 class="site-heading">RECENT</h2>
        <hr>
        <div class="row store-items">
            @foreach($recent_products as $product)          
            <div class="col-md-3" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                {!! view('home.products._product', ['product' => $product]) !!}
            </div>
            @endforeach
        </div>

        <h2 class="site-heading">HOT</h2>
        <hr>
        <div class="row store-items">
            @foreach($recent_products as $product)          
            <div class="col-md-3" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                {!! view('home.products._product', ['product' => $product]) !!}
            </div>
            @endforeach
        </div>

        <h2 class="site-heading">POPULAR</h2>
        <hr>
        <div class="row store-items">
            @foreach($recent_products as $product)          
            <div class="col-md-3" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                {!! view('home.products._product', ['product' => $product]) !!}
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="site-content site-section">
    <div class="container">
        <h2 class="site-heading">CATEGORIES</h2>
        <hr>

        {!! view('home.categories._index', ['categories' => Cache::get('categories')]) !!}
        
    </div>
</section>

@endsection
