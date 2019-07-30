
    <div id="subtitle-list" class="container-fluid">

        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#subtitles" aria-controls="subtitles" role="tab" data-toggle="tab">SubtitleList</a></li>
            <li role="presentation"><a href="#upload-subtitles" aria-controls="upload-subtitles" role="tab" data-toggle="tab">Upload</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">

            <div role="tabpanel" class="tab-pane active" id="subtitles">
                <div id="subtitleList"></div>
            </div>

            <div role="tabpanel" class="tab-pane" id="upload-subtitles">
                {!! view('admin.subtitles.upload') !!}
            </div>

        </div>
    </div>

<script type="text/javascript">

    var Page = require('subtitles_show');
    var pageObject = new Page.default();

    pageObject.load_subtitles();

    $(document).ready(function(){

        $('a[href="#subtitles"]').click(function () {
            pageObject.unload_subtitles();
            pageObject.load_subtitles();
        });

    });

</script>

