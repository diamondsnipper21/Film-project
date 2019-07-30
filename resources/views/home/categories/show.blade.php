@extends('layouts.home.app')

@section('title')
  <title>ABC</title>
@endsection

@section('content')

<!-- Intro -->
<div class="media-container">
    <section class="site-section site-section-light site-section-top themed-background-dark">
        <div class="container text-center">
            <h1 class="animation-slideDown"><strong>{{ $category->name }}</strong></h1>
            <h2>
                {{ $category->description }}
            </h2>
        </div>
    </section>
    <img src="{{asset($category->featured_image_url)}}" alt="" class="media-image animation-pulseSlow">
</div>
<!-- END Intro -->

<!-- Products -->
<section class="site-content site-section">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-4 col-lg-3">
                <aside class="sidebar site-block">
                    <div class="sidebar-block">
                        <h4>CATEGORIES</h4>
                        <ul class="store-menu">
                        @foreach(Cache::get('categories') as $item)
                            <li><a @if($category->slug == $item->slug)) class = 'active' @endif href="{{ $item->slug }}">{{ $item->name }}</a></li>
                        @endforeach
                        </ul>
                    </div>

                    <div class="sidebar-block">
                        <h4>YEARS</h4>
                        @foreach($years as $year)
                            <a class="badge">{{ $year }}</a>
                        @endforeach
                    </div>

                    <div class="sidebar-block">
                        <h4>TAGS</h4>
                        @foreach($tags as $tag)
                            <a class="badge">{{ $tag->slug }}</a>
                        @endforeach
                    </div>
                    
                </aside>
            </div>
            <!-- END Sidebar -->

            <!-- Products -->
            <div class="col-md-8 col-lg-9">
                <div class="form-inline push-bit clearfix">
                    <form id="result-sort-form" action="">
                        <select id="sort" name="sort" onchange="this.form.submit()" class="form-control" size="1">
                            <option value="" disabled selected>SORT BY</option>
                            <option value="title|asc">Name (A to Z)</option>
                            <option value="title|dsc">Name (Z to A)</option>
                        </select>
                    </form>
                </div>
                <div class="row store-items">
                        @foreach ($products as $index => $product) 
                            <div class="col-md-4 visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                                {!! view('home.products._product', ['product' => $product]) !!}
                            </div>

                            @if ( ($index + 1) % 3 == 0 )
                                <div class="clearfix"></div>
                            @endif
                        @endforeach
                                      
                        {{ $products->links() }}
                </div>
            </div>
            <!-- END Products -->
        </div>
    </div>
</section>
<!-- END Product List -->
@endsection
@section('script')
    <script>require('home/favourite');</script>
@endsection