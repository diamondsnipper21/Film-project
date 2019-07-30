@extends('layouts.user.app')

@section('title')
	<title>Film User</title>
@endsection
       
@section('content')

  <div id="user-information-container" class="block">
    <div class="container">
      	<div class="content-header">
      		<div class="header-section">
      			<h1>My Favourite Movies</h1>
      			@if(isset($success))
      				@if($success)
      					<div class="alert alert-success alert-dismissable">
	      					<h4>
	      						<i class="fa fa-check-circle"></i>
	      						Success
	      					</h4>
	      				</div>
      				@else
      					<div class="alert alert-danger alert-dismissable">
	      					<h4>
	      						<i class="fa fa-times-circle"></i>
	      						Failed
	      					</h4>
	      				</div>
      				@endif
      			@endif
      		</div>
      	</div>
        <div class="content">
          <div class="row">
            @foreach($favourite_movies as $movie)
                <div class="col-sm-3 widget">
                  <div class="widget-advanced">
                    <div class="text-center widget-header" style="background-image:url(/img/placeholders/photos/photo16.jpg)">
                      <h3 class="widget-content-light">
                        <a href="{{ url('movie-detail/' . $movie->id) }}" class="themed-color-fire">                        
                          {{ $movie->title }}
                        </a>     
                      </h3>
                      <div class="widget-options">
                        <a href = "" class="btn btn-xs btn-default" data-confirm="Are you sure to remove?" method="POST" data-toggle="tooltip" title="Remove from Wish List">
                          <i class="fa fa-times text-danger"></i>
                        </a>                        
                      </div>                           
                    </div>
                    <div class="widget-main">
                        <a href="" class="widget-image-container animation-bigEntrance">
                          <span class="widget-icon themed-background">
                            <i class="gi gi-play">                              
                            </i>
                          </span>
                        </a>
                        <span>
                          {{ $movie->description }}
                        </span>
                      </div>
                  </div>                  
                </div>
            @endforeach            
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
@endsection