<div class="row store-items">            
    @foreach($categories as $category)
        <div class="col-md-2" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
            <div class="store-item">
                <div class="store-item-image">
                    <a href="{{ route('home.category.show', $category->slug) }}">
                        <img src="{{ $category->featured_image_url() }}" alt="" class="img-responsive">
                    </a>
                </div>
                
                <div class="store-item-info clearfix">
                    <a href="{{ route('home.category.show', $category->slug) }}"><strong>{{$category->name}}</strong></a><br>                        
                </div>

            </div>
        </div>
    @endforeach
</div>