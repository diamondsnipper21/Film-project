@extends('layouts.user.app')

@section('title')
	<title>Film User</title>
@endsection
       
@section('content')

  <div id="user-information-container" class="block">
    <div class="container">
      	<div class="content-header">
      		<div class="header-section">
      			<h1>My Account Information</h1>
      			<br>      			
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
          <form action="{{ route('user.information.update') }}" id="form_submit" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" onsubmit="onSave();return false;">
          {{ csrf_field() }}
              <div class="block form-group">
              	<div class="block-title">
              		<h2><strong>Username</strong></h2>
              	</div>                
                <div class="col-md-8">
                  	<input type="" id="name" name="name" class="form-control" value="{{$user->name}}"/>
                </div>
              </div>
              <div class="block form-group">
              	<div class="block-title">
              		<h2><strong>Email</strong></h2>
              	</div>                
                <div class="col-md-8">
                  	<input type="email" id="email" name="email" class="form-control" value="{{$user->email}}"/>
                </div>
              </div>
              <div class="block form-group">
              	<div class="block-title">
              		<h2><strong>Subscription</strong></h2>
              	</div>                
                <div class="col-md-8">
                	<label class="switch switch-primary" data-toggle="tooltip" title="Subscription">
                        <input type="checkbox" id="subscription" name="subscription"  {{ ($user->subscription==1) ? 'checked' : '' }}>
                        <span></span>
                    </label>                  	
                </div>
              </div>
              		
              <div class="block form-group">
              	<div class="block-title">
              		<h2><strong>New Password</strong></h2>
              	</div>                
                <div class="col-md-8">
                  	<input type="password" id="new_password" name="new_password" class="form-control" autosave="disabled"/>
                </div>
              </div>
              <div class="block form-group">
              	<div class="block-title">
              		<h2><strong>Confirm New Password</strong></h2>
              	</div>                
                <div class="col-md-8">
                  	<input type="password" id="confirm_password" name="confirm_password" class="form-control" />
                </div>
              </div>              
            <div class="form-group form-actions">
              <div class="col-xs-12 text-right">
                <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
              </div>
            </div>
          </form>
        </div>
            <!-- END Modal Body -->
      </div>
    </div>
  </div>
@endsection
@section('script')
<script type="text/javascript">
	function onSave(){
		var new_pass = $('#new_password').val();
		var confirm_pass = $('#confirm_password').val();
		if (new_pass != confirm_pass) {
			alert('Wrong Password');
			return false;
		};
		$('#form_submit').submit();
	}
</script>
@endsection