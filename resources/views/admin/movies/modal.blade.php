<div class="modal fade" id="movieModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cancel"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Movies</h4>
            </div>
            <div class="modal-body">

                <div id="movie-list" class="container-fluid">
                    <div id="movieList"></div>
                </div>

                <input type="hidden" id="movie-id" value=""/>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">

    var Page = require('movies_modal');
    var pageObject = new Page.default();

    pageObject.load_movies();

</script>

