@extends('layouts.admin.app')

@section('title')
    <title>Categories - Film</title>
@endsection
             
@section('content')
    <h1>Categories</h1>
    
    <div class="row text-center" id="categories">
    @foreach ($categories as $category)
        <div class="col-sm-6 col-lg-3 item" data-id="{{$category->id}}" id="category-{{$category->id}}">
            <!-- Widget -->
            <a href="{{ route('admin.categories.edit', $category->id) }}" class="widget widget-hover-effect1 thumbnail bg-info">
                <div class="widget-simple">
                    <img src="{{ $category->featured_image_url() }}" alt="Paris" class="img-thumbnail pull-center">
                    <h4>{{ $category->name }}</h4>
                    <h5>Products ({{ count($category->products) }})</h5>
                </div>
            </a>
            <!-- END Widget -->
        </div>
    @endforeach
    </div>
    <div class="row text-center">
        <div class="col-sm-6 col-lg-3">
            <!-- Widget -->
            <a href="{{ route('admin.categories.create') }}" class="widget widget-hover-effect1 thumbnail bg-danger animation-fadeIn">
                <div class="widget-simple" style="margin: 55px 0">
                    <div class="widget-icon pull-center themed-background-autumn">
                        <i class="fa fa-plus fa-fw"></i>
                    </div>
                    <h4>Add New Category</h4>
                </div>
            </a>
            <!-- END Widget -->
        </div>
    </div>

    <script type="text/javascript">

            var API = require('api').default;

            // Rubaxa sortable
            var el = document.getElementById('categories');
            var sortable = Sortable.create(el, {
                dataIdAttr: 'data-id',
                draggable: ".item",
                onUpdate: function (evt) {
                    var itemEl = evt.item;  // dragged HTMLElement
                    var sorted_ids = this.toArray();

                    if (evt.oldIndex < evt.newIndex) {
                        API.categories.update_position(sorted_ids[evt.newIndex], sorted_ids[evt.newIndex - 1]);
                    } else {
                        API.categories.update_position(sorted_ids[evt.newIndex], sorted_ids[evt.newIndex + 1]);
                    }
                },
            });
    </script>
@endsection