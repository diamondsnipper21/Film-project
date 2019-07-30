
    <div id="video-list" class="container-fluid">

        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#videos" aria-controls="videos" role="tab" data-toggle="tab">VideoList</a></li>
            <li role="presentation"><a href="#upload-videos" aria-controls="upload-videos" role="tab" data-toggle="tab">Upload</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">

            <div role="tabpanel" class="tab-pane active" id="videos">
                <div id="videoList"></div>
            </div>

            <div role="tabpanel" class="tab-pane" id="upload-videos">
                {!! view('admin.videos.upload') !!}
            </div>

        </div>
    </div>


<script type="text/javascript">

    $(document).ready(function(){

        var Page = require('videos_show');
        var pageObject = new Page.default();

        pageObject.load_videos();

        $('a[href="#videos"]').click(function () {
            pageObject.unload_videos();
            pageObject.load_videos();
        });
    });

</script>
