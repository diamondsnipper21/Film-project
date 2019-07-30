 <!--tags-->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Tags({!! count($product->tags) !!})</h3>
    </div>
    <div class="panel-body">
        <div>
            <input id="tags" class="form-control" placeholder="Tags here" requried="" name="tags" type="text" value="">

            <a href="javascript:void(0);" onclick="add_tags_to_product();" class="btn btn-warning btn-sm">Add tag</a>
            <br/><br/>
            
            <div id="product-tags">
                <span v-for="item in items">
                    <a href="javascript: void(0);" v-on:click="untag(item.slug)" class="badge">@{{ item.slug }} <i class="fa fa-close"></i></a>
                    &nbsp;
                </span>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var API = require('api').default;

    var Tags = new Vue({
      el: '#product-tags',
      data: {
        items: {!! $product->tags->toJSON() !!},
        product_id: {{ $product->id }},
      },
      methods: {
        untag: function (slug) {
            API.products.untag(this.product_id, slug)
                        .then(function (res) {
                            return res.json();
                        }).then(function (result) {
                            Tags.items = result;
                        }, function (error) {});
        },

        tag: function (slug) {
            API.products.tag(this.product_id, slug)
                        .then(function (res) {
                            return res.json();
                        }).then(function (result) {
                            Tags.items = result;
                        }, function (error) {});
        },
      }
    });

    function add_tags_to_product(){
        Tags.tag($('#tags').val());
        $('#tags').val('');
    }
</script>