@extends('layouts.user.app')

@section('title')
	<title>Film User</title>
@endsection
       
@section('content')

  <div id="user-information-container" class="block">
    <div class="container">
      	<div class="content-header">
      		<div class="header-section">
      			<h1>My Reviews</h1>
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
          <ul class="media-list push">
            @foreach($reviews as $review)
                <li class="media">
                  <a href="" class="pull-left">
                      <img src="/img/placeholders/avatars/avatar5.jpg" alt="Avatar" class="img-circle">
                  </a>
                  <div class="media-body">
                      <a href=""><span class="{{($review->approved == 1)?'':'text-muted'}}"><strong>{{ $review->movie_name }}</strong></span></a>
                      <span class="text-muted"><small><em>{{ $review->time }}</em></small></span>
                      <p>{{ $review->description }}</p>
                  </div>
                </li>
            @endforeach    
          </ul>        
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
@endsection