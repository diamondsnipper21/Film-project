<div class="store-item">
    <div class="store-item-image">
        <a href="{{ route('home.product.show', $product->slug) }}">
            <img src="{{ $product->featured_image_url() }}" alt="" class="img-responsive">
        </a>
    </div>

    <div class="store-item-info clearfix">
        <p>
            <a href="{{ route('home.product.show', $product->slug) }}"><strong>{{ $product->name }}</strong></a>
        </p>

        <p>
        	{{ implode( $product->category_names()->toArray(), ',' ) }}
        </p>
        <p>
            <span>
                <i class="fa fa-clock-o"></i>
                {{ $product->duration_in_minutes() }} minutes
            </span>
            &nbsp;&nbsp;
            <span>
                <i class="fa fa-star"></i>
                {{ $product->rating() }}
            </span>
        </p>

    </div>

</div>