<div class="modal fade" id="seriesModal" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cancel"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Series</h4>
            </div>
            <div class="modal-body">

            {!! Form::open(['url' => route('admin.movie.series.store', [$movie_id]), 'method' => 'post', 'files' => true, 'id'=>'seriesForm']) !!}
                {!! Form::hidden('movie_id', $movie_id) !!}

                <div class="form-group">
                    <div class="row">
                        {!! Form::label('title', 'Title:', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title here']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        {!! Form::label('order', 'Order:', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('order', '', ['class' => 'form-control', 'placeholder' => 'Order here']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        {!! Form::label('description', 'Description:', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Description here']) !!}
                        </div>
                    </div>
                </div> 

            {!! Form::close() !!}

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onClick="$('#seriesForm').submit();">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
