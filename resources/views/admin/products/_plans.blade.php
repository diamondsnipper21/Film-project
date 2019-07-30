<!--plans-->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Plans</h3>
    </div>
    <div class="panel-body">

        <div id="product-plans">
            <select class="form-control" id="plans">
                <option v-for="item in available_items" v-bind:value="item.id">@{{ item.formatted_name }}</option>
            </select>
            <div>
                <a href="javascript:void(0);" onclick="add_plan_to_product();" class="btn btn-warning btn-sm">Add Plan</a>
                <br/>
                <br/>
            </div>
            <div>
                @foreach(App\ProductPlan::existingTags() as $tag)
                    <a href="javascript: void(0);" v-on:click="add_tagged_plans('{{$tag->slug}}')">Add {{ $tag->slug }} plans</a>
                @endforeach
            </div>
            <hr/>
            <div>
                <span v-for="item in items">
                    <a href="javascript: void(0);" v-on:click="remove(item.id)" class="badge">@{{ item.formatted_name }}<i class="fa fa-close"></i></a>
                    &nbsp;
                </span>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var API = require('api').default;
    var _ = require('underscore');

    var available_plans = {!! App\ProductPlan::all()->toJSON() !!};
    var product_plans = {!! $product->plans->toJSON() !!};
    var Plans = new Vue({
      el: '#product-plans',
      data: {
        available_items: available_plans,
        items: [],
        product_id: {{ $product->id }},
      },
      methods: {
        remove: function (slug) {
            API.products.remove_plan(this.product_id, slug)
                        .then(function (res) {
                            return res.json();
                        })
                        .then(function (result) {
                             Plans.load(result);
                        });
        },

        add: function (slug) {
            API.products.add_plan(this.product_id, slug)
                .then(function (res) {
                            return res.json();
                })
                .then(function (result) {
                     Plans.load(result);
                });
        },

        add_tagged_plans: function(tag_slug)
        {
            API.products.add_tagged_plans(this.product_id, tag_slug)
                .then(function (res) {
                    return res.json();
                })
                .then(function (result) {
                     Plans.load(result);
                });
        },

        load: function(items){
            Plans.items = items;
        }
      }
    });

    Plans.load(product_plans);

    function add_plan_to_product (){
        Plans.add($('#plans').val());
        $('#plans').val('');
    }
</script>