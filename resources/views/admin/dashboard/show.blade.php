@extends('layouts.admin.app')

@section('title')
	<title>Film Admin</title>
@endsection


@section('content')
    <!-- Dashboard Header -->
    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->
    <div class="content-header content-header-media">
        <div class="header-section">
            <div class="row">
                <!-- Main Title (hidden on small devices for the statistics to fit) -->
                <div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
                    <h1>Welcome <strong>{{ Auth::user()->name }}</strong><br><small>You Look Awesome!</small></h1>
                </div>
                <!-- END Main Title -->

                <!-- Top Stats -->
                <div class="col-md-8 col-lg-6">
                    <div class="row text-center">
                        <div class="col-xs-4 pull-right">
                            <h2 class="animation-hatch">
                                <strong>{{ $products_count }}</strong><br>
                                <small><i class="gi gi-shopping_bag"></i> Products</small>
                            </h2>
                        </div>
                        <div class="col-xs-4 pull-right">
                            <h2 class="animation-hatch">
                                <strong>{{ $categories_count }}</strong><br>
                                <small><i class="fa fa-list"></i> Categories</small>
                            </h2>
                        </div>
                        <div class="col-xs-4 pull-right">
                            <h2 class="animation-hatch">
                                <strong>{{ $users_count }}</strong><br>
                                <small><i class="fa fa-user"></i> Users</small>
                            </h2>
                        </div>
                    </div>
                </div>
                <!-- END Top Stats -->
            </div>
        </div>
        <!-- For best results use an image with a resolution of 2560x248 pixels (You can also use a blurred image with ratio 10:1 - eg: 1000x100 pixels - it will adjust and look great!) -->
        <img src="img/placeholders/headers/store_home.jpg" alt="header image" class="animation-pulseSlow">
    </div>
@endsection