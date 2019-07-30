@extends('layouts.user.app')

@section('title')
	<title>Film User</title>
@endsection
       
@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2">
				<div class="block full">
					<div class="block-title">
						<h5>YEAR:</h5>
					</div>
					<div class="row">
							<a class="col-sm-4" href="{{ route('user.categories.show', ['slug' => $category->slug, 'year' => 'all']) }}">All</a>
						@foreach ($category->years() as $index => $year1)
							<a class="col-sm-4" href="{{ route('user.categories.show', ['slug' => $category->slug, 'year' => $year1]) }}">{{ $year1 }}</a>
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-sm-10">
				<div class="block full">
					<div class="block-title">
						<h6>
							<a href="{{ route('user.categories.show', ['slug' => $category->slug, 'year' => $year, 'sort_by' => 'name', 'sort_order' => $sort_order ]) }}">
							@if ($sort_by == 'name' && $sort_order == 'asc')
								<i class="fa fa-angle-up">
							@elseif ($sort_by == 'name' && $sort_order == 'dsc')
								<i class="fa fa-angle-down">
							@endif
								Alphabetic</i>
							</a>
						</h6>
						<h6>
							<a href="{{ route('user.categories.show', ['slug' => $category->slug, 'year' => $year, 'sort_by' => 'created_at', 'sort_order' => $sort_order ]) }}">
							@if ($sort_by == 'created_at' && $sort_order == 'asc')
								<i class="fa fa-angle-up">
							@elseif ($sort_by == 'created_at' && $sort_order == 'dsc')
								<i class="fa fa-angle-down">
							@endif
								Recent</i>
							</a>
						</h6>
					</div>
					<div class="row">
					@foreach ($products as $index => $product)
						<div class="col-md-3">
						    <div class="">
						    	<a href="{{ route('user.products.show', $product->id) }}" class="thumbnail widget widget-hover-effect1">
                                    <img src="{{ $product->featured_image_url }}" alt="featured" />
                                    <div class="caption">
						          		<p>{{ $product->name }}</p>
						        	</div>
                                </a>
						    </div>
					    </div>
					    @if (($index + 1) % 4 == 0)
					    	<div class="clearfix"></div>
					    @endif
					@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection