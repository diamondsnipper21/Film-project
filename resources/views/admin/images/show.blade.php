
    <div id="image-list" class="container-fluid">

        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#images" aria-controls="images" role="tab" data-toggle="tab">ImageList</a></li>
            <li role="presentation"><a href="#upload-images" aria-controls="upload-images" role="tab" data-toggle="tab">Upload</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">

            <div role="tabpanel" class="tab-pane active" id="images">
                <div id="imageList"></div>
            </div>

            <div role="tabpanel" class="tab-pane" id="upload-images">
                {!! view('admin.images.upload') !!}
            </div>

        </div>
    </div>

<script type="text/javascript">

    var ImagesPage = require('images_show');
    var ImagesPageObject = new ImagesPage.default();

    ImagesPageObject.load_images();

    $(document).ready(function(){

        $('a[href="#images"]').click(function () {
            ImagesPageObject.unload_images();
            ImagesPageObject.load_images();
        });
    });

</script>

