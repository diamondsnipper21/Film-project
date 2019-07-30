@extends('layouts.admin.app')

@section('title')
  <title>Reviews</title>
@endsection

@section('content')

    <div class="container-fluid">
    	<div class="pull-right">
    		<a href="{{ route('admin.reviews.create') }}" data-toggle="tooltip" title="Add New" class="btn btn-primary">
    			<i class="fa fa-plus"></i>
    		</a>
      	</div>

      	<h2>Reviews</h2>

        <div class="panel panel-default">
      		<div class="panel-heading">
        		<h3 class="panel-title"><i class="fa fa-list"></i> Review List</h3>
      		</div>
	      	<div class="panel-body">
<!-- 	        	<div class="well">
		          	<div class="row">
			            <div class="col-sm-6">
			              	<div class="form-group">
			                	<label class="control-label" for="input-product">Movie</label>
			                	<input type="text" name="filter_product" value="" placeholder="Movie" id="input-product" class="form-control" />
			              </div>
			              <div class="form-group">
			                <label class="control-label" for="input-author">Author</label>
			                <input type="text" name="filter_author" value="" placeholder="Author" id="input-author" class="form-control" />
			              </div>
			            </div>
			            <div class="col-sm-6">
			              	<div class="form-group">
				                <label class="control-label" for="input-status">Status</label>
				                <select name="filter_status" id="input-status" class="form-control">
				                  	<option value="*"></option>
				                    <option value="1">Enabled</option>
				                    <option value="0">Disabled</option>
				                </select>
			              	</div>
			              	<div class="form-group">
			                	<label class="control-label" for="input-date-added">Date Added</label>
			                	<div class="input-group date">
			                  		<input type="text" name="filter_date_added" value="" placeholder="Date Added" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control" />
			                  		<span class="input-group-btn">
			                  			<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
			                  		</span>
			                  	</div>
			              	</div>
			              	<button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-filter"></i> Filter</button>
			            </div>
	          		</div>
	        	</div> -->
	          	<div class="table-responsive">
		            <table class="table table-bordered table-hover">
		              	<thead>
		                	<tr>
			                  	<td style="width: 1px;" class="text-left">
			                  		<a href="">No</a>
			                  	</td>
			                  	<td class="text-left">
			                  		<a href="">Movie</a>
			                    </td>
			                  	<td class="text-right">                    
			                  		<a href="">Rating</a>
			                    </td>
			                  	<td class="text-left">                    
			                  		<a href="">Status</a>
			                    </td>
			                  	<td class="text-left">                    
			                  		<a href="" class="desc">Date Added</a>
			                    </td>
			                  	<td class="text-right">Action</td>
			                </tr>
		              	</thead>
		              	<tbody>
		              	@if ($reviews->count() == 0)
		              		<tr>
		                  		<td class="text-center" colspan="7">No results!</td>
		                	</tr>
		                @endif
		              	@foreach ($reviews as $index => $review)
		                    <tr>
                            	<td style="width: 1px;" class="text-left">{{ ($reviews->currentPage() - 1) * $reviews->perPage() + $index + 1 }}</td>
		                  		<td class="text-left">{{ $review->product->name }}</td>
		                  		<td class="text-right">{{ $review->score }}</td>
		                  		<td class="text-left">
		                  			@if ($review->approved == 0)
		                  				Disabled
		                  			@else
		                  				Enabled
		                  			@endif
		                  		</td>
		                  		<td class="text-left">@datetime($review->updated_at)</td>
		                  		<td class="text-right">
		                  			<a href="{{ route('admin.reviews.edit', $review->id) }}" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit">
		                  				<i class="fa fa-pencil"></i>
		                  			</a>
	                                <a method="DELETE" href="{{ route('admin.reviews.destroy', $review->id) }}" data-confirm="Are you sure to delete?" class="btn btn-danger">
	                                    <i class="fa fa-trash"></i>
	                                </a>
		                  		</td>
		                	</tr>
		                @endforeach
		                </tbody>
		            </table>
		            {!! $reviews->links() !!}
	          	</div>
	        </div>
    	</div>
    </div>
@endsection
