<h1>MOVIE PLAY EDIT</h1>
<div class="clearfix">
    <div class="pull-right">
        <a href="{{ route('admin.movies.edit', $play->movie->id) }}" class="btn btn-primary">
            <i class="fa fa-reply">Back</i>
        </a>
    </div>
</div>

<div class="row">
	<div class="col-sm-3"><label>Title</label></div>
	<div class="col-sm-9">{{ $play->movie->title }}</div>
</div>

<div class="row">
	<div class="col-sm-3"><label>Description</label></div>
	<div class="col-sm-9">{{ $play->movie->description }}</div>
</div>
<hr/>
