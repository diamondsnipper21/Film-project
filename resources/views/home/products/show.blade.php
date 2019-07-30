@extends('layouts.home.app')

@section('title')
  <title>{{ $product->name }}</title>
@endsection

@section('content')
<!-- Intro -->
<div class="media-container">
    <section class="site-section site-section-light site-section-top themed-background-dark">
        <div class="container text-center">
            <h1 class="animation-slideDown"><strong><?php echo $product->name?></strong></h1>
        </div>
    </section>
    <img src="{{asset($product->featured_image_url)}}" alt="" class="media-image animation-pulseSlow">
</div>
<!-- END Intro -->

<!-- Product View -->
<section class="site-content site-section product">
    <div class="container">
        <div class="row">

            <!-- Product Details -->
            <div class="col-md-12">
                <div class="row" data-toggle="lightbox-gallery">
                    <!-- Images -->
                    <div class="col-sm-8 push-bit">
                        <div class="featured-image">
                            <a id="featured-image" href="<?php echo asset($product->featured_image_url) ?>" class="gallery-link">
                                <img src="<?php echo asset($product->featured_image_url) ?>" alt="" class="img-responsive push-bit">
                            </a>
                        </div>
                        <div class="thumbnails">
                            <div class="row">
                                @foreach($product->images as $image)
                                    @if($image->url != $product->featured_image_url)
                                    <div class="col-sm-3">
                                        <a href="javascript: void(0);" onclick="bringToFeaturedImage('{{ $image->url }}');">
                                            <img class="img-responsive" src="{{ $image->url }}" />
                                        </a>
                                    </div>
                                    @endif
                                @endforeach

                                <script type="text/javascript">
                                    function bringToFeaturedImage(url){
                                        $('#featured-image').attr('href', url);
                                        $('#featured-image img').attr('src', url);
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                    <!-- END Images -->

                    <!-- Info -->
                    <div class="col-sm-4 push-bit">
                        <div class="clearfix">
                            <span class="h4"><strong class="text-success">NEW</strong></span>
                        </div>

                        <p>
                            {{ implode( $product->category_names()->toArray(), ',' ) }}
                        </p>
                        
                        <div>
                            <p>{{ $product->description }}</p>
                        </div>

                        <div>
                            {{ implode($product->tags->pluck('slug')->toArray(), ',') }}
                        </div>

                        <div>
                            <span><i class="fa fa-clock-o"></i>&nbsp; {{ $product->duration_in_minutes() }} minutes</span>
                        </div>

                        <div>
                            <span><i class="fa fa-calendar"></i>&nbsp; {{ $product->year }} by {{ $product->make }}</span>
                        </div>

                        <div>
                            <span><i class="fa fa-star"></i>&nbsp; {{ $product->rating() }}</span>
                        </div>

                    </div>
                    <!-- END Info -->

                    <!-- More Info Tabs -->
                    <div class="col-xs-12 site-block">
                        <ul class="nav nav-tabs push-bit" data-toggle="tabs">
                            <li class="active"><a href="#product-description">Related Products</a></li>
                            <li><a href="#product-reviews">Reviews ( {{ $product->rating() }})</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="product-description">
                                <div class="row">
                                    @foreach($product->related_products()->take(6) as $related_product)
                                        <div class="col-md-2" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                                            <div class="store-item">
                                                <div class="store-item-image">
                                                    <a href="{{ route('home.product.show', $related_product->slug) }}">
                                                        <img src="{{ $related_product->featured_image_url }}" alt="" class="img-responsive">
                                                    </a>
                                                </div>
                                                <div class="store-item-info clearfix">
                                                    <span class="store-item-price themed-color-dark pull-right">{{ $related_product->price }}</span>
                                                    <a href="{{ route('home.product.show', $related_product->slug) }}"><strong>{{ $product->name }}</strong></a><br>
                                                    <p>
                                                        <span>
                                                            <i class="fa fa-clock-o"></i>
                                                            {{ $related_product->duration_in_minutes() }} minutes
                                                        </span>
                                                    </p>              
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane" id="product-reviews">
                                <ul class="media-list push">
                                    @foreach($product->reviews as $review)
                                        @if($review->approved == 1)
                                        <li class="media">
                                            <a href="javascript:void(0)" class="pull-left">
                                                <img src="/img/placeholders/avatars/avatar1.jpg" alt="Avatar" class="img-circle">
                                            </a>
                                            <div class="media-body">
                                                <div class="text-warning pull-right">
                                                    @for($i = 0; $i < 10; $i++) 
                                                        <i class="fa {{$i < $review->score?'fa-star':'fa-star-o'}}"></i>
                                                    @endfor                                                    
                                                </div>
                                                <a href="javascript:void(0)"><strong>{{ $review->user_name }}</strong></a><br>
                                                <span class="text-muted"><small><em>@datetime($review->created_at)</em></small></span>
                                                <p>{{ $review->description }}</p> 
                                            </div>
                                        </li>
                                        @endif
                                    @endforeach         
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- END More Info Tabs -->
                </div>
                <h2>CATEGORIES</h2>
                {!! view('home.categories._index', ['categories' => Cache::get('categories')]) !!}
            </div>
            <!-- END Product Details -->

        </div>
    </div>


</section>
<!-- END Product View -->

@endsection