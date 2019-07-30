<?php
Route::post('stripe/webhook', 'WebhookController@handleWebhook');

Route::group(['as' => 'home.', 'namespace' => 'Home'], function () {
    Route::get('/', 'PagesController@home');
    Route::get('pages/{page}', 'PagesController@show');
    Route::get('products/{id}','ProductsController@show')->name('product.show');
    Route::get('search/','SearchController@show');
    Route::get('categories/{slug}', ['as' => 'category.show', 'uses' => 'CategoriesController@show']);
});

Route::group(['as' => 'admin.', 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Auth::routes();

    Route::resource('users', 'UsersController');

    Route::resource('categories', 'CategoriesController');
    Route::resource('products', 'ProductsController');
    Route::resource('movies', 'MoviesController');
    Route::resource('series', 'SeriesController');
    Route::resource('images', 'ImagesController');
    Route::resource('plays', 'PlaysController');
    Route::resource('videos', 'VideosController');
    Route::resource('subtitles', 'SubtitlesController');
    Route::resource('reviews', 'ReviewsController');
    
    Route::resource('plans', 'PlansController');

    Route::resource('product_plans', 'ProductPlansController');
    Route::delete('/product_plans/{id}/untag/{tag}', [ 'as' => 'plans.untag', 'uses' => 'PlansController@untag']);

    Route::resource('subscriptions', 'SubscriptionsController');
    

    Route::get('/', 'DashboardController@index');
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

    Route::get('categories/{category_id}/products/', [ 'as' => 'categories.products', 'uses' => 'CategoriesController@products']);
    Route::post('categories/{category_id}/add_products/', [ 'as' => 'categories.add_products', 'uses' => 'CategoriesController@add_products']);
    Route::delete('categories/{category_id}/remove_product/{product_id}', [ 'as' => 'categories.remove_product', 'uses' => 'CategoriesController@remove_product']);
    Route::delete('categories/{category_id}/remove_products/', [ 'as' => 'categories.remove_products', 'uses' => 'CategoriesController@remove_products']);

    Route::get('products/{product_id}/categories/', [ 'as' => 'products.categories', 'uses' => 'ProductsController@categories']);
    Route::post('products/{product_id}/add_categories/', [ 'as' => 'products.add_categories', 'uses' => 'ProductsController@add_categories']);
    Route::delete('products/{product_id}/remove_category/{category_id}', [ 'as' => 'products.remove_category', 'uses' => 'ProductsController@remove_category']);
    Route::delete('products/{product_id}/remove_categories/', [ 'as' => 'products.remove_categories', 'uses' => 'ProductsController@remove_categories']);

    Route::get('series/{series_id}/movies/{movie_id}/edit', [ 'as' => 'series.movies.edit', 'uses' => 'SeriesController@edit']);
    Route::get('series/{series_id}/movies/create', [ 'as' => 'series.movies.create', 'uses' => 'SeriesController@create']);
    Route::post('series/{series_id}/movies', [ 'as' => 'series.movies.store', 'uses' => 'SeriesController@store']);
    Route::post('series/{series_id}/movies/{movie_id}/update', [ 'as' => 'series.movies.update', 'uses' => 'SeriesController@update']);
    Route::get('series/{series_id}/publish_to_product', [ 'as' => 'series.publish_to_product', 'uses' => 'SeriesController@publish_to_product']);

    Route::get('movies/{movie_id}/publish_to_product', [ 'as' => 'movies.publish_to_product', 'uses' => 'MoviesController@publish_to_product']);

    Route::delete('plays/{play_id}/remove_video/{video_id}', [ 'as' => 'plays.remove_video', 'uses' => 'PlaysController@remove_video']);

});

Route::group(['as' => 'user.', 'namespace' => 'User', 'prefix' => 'user'], function () {
    Auth::routes();
    
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@show']);
    Route::get('information', ['as' => 'information', 'uses' => 'UserInformationController@show_information']);
    Route::post('information/update', ['as' => 'information.update', 'uses' => 'UserInformationController@update']);
    Route::get('favourite', ['as' => 'favourite', 'uses' => 'UserFavouriteController@show']);
    Route::get('reviews', ['as' => 'reviews', 'uses' => 'UserReviewController@show']);
    Route::get('categories/{slug}', ['as' => 'categories.show', 'uses' => 'CategoriesController@show']);
    Route::get('products/{product_id}', ['as' => 'products.show', 'uses' => 'ProductsController@show']);
    Route::get('products/{product_id}/play', ['as' => 'products.play', 'uses' => 'ProductsController@play']);
});

