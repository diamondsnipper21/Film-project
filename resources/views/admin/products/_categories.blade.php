<!--categories-->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Categories({!! count($product->categories) !!})</h3>
    </div>
    <div class="panel-body">
        <div id="product-categories">
            <select class="form-control" id="categories">
                <option v-for="item in available_items" v-bind:value="item">@{{ item }}</option>
            </select>
            <a href="javascript:void(0);" onclick="add_category_to_product();" class="btn btn-warning btn-sm">Add Category</a>
            <br/><br/>
            
            <div>
                <span v-for="item in items">
                    <a href="javascript: void(0);" v-on:click="remove(item)" class="badge">@{{ item }} <i class="fa fa-close"></i></a>
                    &nbsp;
                </span>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var API = require('api').default;
    var _ = require('underscore');
    var all_categories = {!! App\Category::pluck('slug')->toJSON() !!};
    var product_categories = {!! $product->categories->pluck('slug')->toJSON() !!};

    var Categories = new Vue({
      el: '#product-categories',
      data: {
        available_items: _.difference(all_categories, product_categories),
        items: product_categories,
        product_id: {{ $product->id }},
      },
      methods: {
        remove: function (slug) {
            API.products.remove_category(this.product_id, slug)
                        .then(function (res) {
                            return res.json();
                        }).then(function (result) {
                            Categories.items = _.pluck(result, 'slug');
                            Categories.available_items = _.difference(all_categories, Categories.items);
                        }, function (error) {});
        },

        add: function (slug) {
            API.products.add_category(this.product_id, slug)
                        .then(function (res) {
                            return res.json();
                        }).then(function (result) {
                            Categories.items = _.pluck(result, 'slug');
                            Categories.available_items = _.difference(all_categories, Categories.items);
                        }, function (error) {});
        },
      }
    });

    function add_category_to_product (){
        Categories.add($('#categories').val());
        $('#categories').val('');
    }
</script>