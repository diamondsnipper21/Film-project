<div class="modal fade" id="playerModal" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cancel"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Player</h4>
            </div>
            <div class="modal-body">

                <video width="100%" controls>
                    <source src="" type="video/mp4">
                    Your browser does not support HTML5 video.
                </video>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    var VideoList = require('components/VideoList');
    $(document).ready(function(){
        VideoList.default.onVideoSelected = function(video, e){
            $('#playerModal video source').attr('src', video.url);
            $('#playerModal video')[0].load();
            $('#playerModal').modal();
        }
    });
</script>