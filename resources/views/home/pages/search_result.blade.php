@extends('layouts.home.app')

@section('title')
  <title>ABC</title>
@endsection

@section('content')
<section class="site-section site-section-light site-section-top">
    <div class="container text-center">
    </div>
</section>
<!-- END Intro -->
<!-- Search Results -->
<section class="site-content site-section">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-4 col-lg-3">
                <aside class="sidebar site-block">
                    <!-- Refine Search -->
                    <div class="sidebar-block">        
                        <form class="form-horizontal" onsubmit="onSearch(); return false;">     
                            <div class="form-group push-bit">           
                                <div class="col-xs-12">
                                    <div class="input-group">
                                        <input type="text" id="search" name="k" class="form-control" placeholder="Search Store.." value="<?php echo $keyword?>">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-primary" default="default"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <h4 class="-header"><strong>Categories</strong></h4>
                            <div class="form-group">
                                @foreach(Cache::get('categories') as $category)
                                <div class="col-xs-12">
                                    <label class="checkbox-inline" for="{{ $category->slug }}">                                        
                                        <input type="checkbox" id="{{ $category->slug }}" name="category" value="{{ $category->id }}" <?php echo in_array($category->id, $selected_categories)? 'checked':''?>> <strong>{{ $category->name }}</strong> <?php echo in_array($category->id, $selected_categories)? '('.count($search_result[$category->name]).')':'';?>
                                    </label>
                                </div>                                
                                @endforeach                                
                            </div>
                        </form>
                    </div>
                    <!-- END Refine Search -->

                    
                </aside>
            </div>
            <!-- END Sidebar -->
            <!-- Products -->
            <div class="col-md-8 col-lg-9">
                <div class="row">
                    <div class="container text-left col-md-8">
                        <p class="animation-slideLeft"><strong>Search Results For '{{($keyword == '')?'all':$keyword}}' (<?php echo count(array_flatten($search_result)) ?></strong> films found!)</p>
                    </div>
                    <div class="form-inline push-bit clearfix pull-right">                      
                        <select id="sort" name="s" onchange="onSearch()" class="form-control <?php echo count(array_flatten($search_result)) == 0? 'hidden':''?>" size="1">
                            @foreach(Cache::get('sort_options') as $sort_option => $sort_name)                        
                                <option value="{{$sort_option}}"<?php echo ($sort_option == $sort)? 'selected':''?>>{{$sort_name}}</option>
                            @endforeach
                        </select>                    
                    </div>
                </div>
                

                <div class="row store-items">
                     
                    @if(count(array_flatten($search_result)) == 0)
                        <div class="text-center text-warning alert alert-danger">
                            <p> No Result </p>
                        </div>
                    @endif
                    <?php
                    foreach ($search_result as $category_name => $movies) {
                        if (count($movies) != 0){
                        ?>
                        <div class="col-md-12 themed-background-dark " style="color:white">
                            <h4>{{ $category_name }}</h4>
                        </div>
                        <?php
                        foreach ($movies as $movie) {                         
                        ?>
                        <div class="col-md-6 visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                            <div class="store-item">
                                <div class="store-item-rating text-warning">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </div>
                                <div class="store-item-image">
                                    <a href="<?php echo url('movie-detail/'.$movie->id)?>">
                                        <img src="<?php echo asset($movie->image_url);?>" alt="" class="img-responsive">
                                    </a>
                                </div>
                                <div class="store-item-info clearfix">
                                    <span class="store-item-price themed-color-dark pull-right">$100</span>
                                    <a href="<?php echo url('movie-detail/'.$movie->id)?>"><strong><?php echo $movie->title?></strong></a><br>
                                    <small><i class="fa fa-shopping-cart text-muted"></i> <a href="javascript:void(0)" class="text-muted">Add to cart</a></small>
                                </div>
                            </div>
                        </div>  
                        <?php  
                            }
                        }
                    }
                    ?>                   
                    
                </div>
            </div>
            <!-- END Products -->
        </div>
    </div>
</section>
<!-- END Search Results -->
<script type="text/javascript">
    function onSearch(){
        var url = "/search/?k="+$('#search').val()+"&";
        var params = [];

        var categories = [];
        $('input[name="category"]:checked').each(function(){
            categories.push($(this).val());
        });
        if (categories.length) {
            params.push("c="+categories.join('-'));
        }

        if ($('#sort').val() != "") {
            params.push("s="+$('#sort').val());
        }

        if (params.length) {
            url += params.join('&');
        }

        location.href = url;        
    }
    $(document).ready(function(){

    });
</script>
@endsection
