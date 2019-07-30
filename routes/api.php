<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/api/v1/token', [ 'as' => 'token', 'uses' => 'Api\V1\TokensController@store']);

Route::group(['middleware'=>'jwt.auth', 'as' => 'v1.', 'namespace' => 'Api\V1', 'prefix' => 'v1'], function () {

    Route::get('/images', [ 'as' => 'images', 'uses' => 'ImagesController@index']);
    Route::get('/movies', [ 'as' => 'movies', 'uses' => 'MoviesController@index']);
    Route::get('/subtitles', [ 'as' => 'subtitles', 'uses' => 'SubtitlesController@index']);
    Route::get('/videos', [ 'as' => 'videos', 'uses' => 'VideosController@index']);
    Route::get('/products', [ 'as' => 'products', 'uses' => 'ProductsController@index']);

    Route::post('/movies/{movie_id}/add_image', [ 'as' => 'movies.add_image', 'uses' => 'MoviesController@add_image']);
    Route::delete('/movies/{movie_id}/remove_image', [ 'as' => 'movies.remove_image', 'uses' => 'MoviesController@remove_image']);
    Route::post('/movies/{movie_id}/update_featured_image', [ 'as' => 'movies.update_featured_image', 'uses' => 'MoviesController@update_featured_image']);

    Route::post('/series/{series_id}/add_image', [ 'as' => 'series.add_image', 'uses' => 'SeriesController@add_image']);
    Route::delete('/series/{series_id}/remove_image', [ 'as' => 'series.remove_image', 'uses' => 'SeriesController@remove_image']);
    Route::post('/series/{series_id}/update_featured_image', [ 'as' => 'series.update_featured_image', 'uses' => 'SeriesController@update_featured_image']);
    Route::post('/series/{series_id}/add_movie', [ 'as' => 'series.add_movie', 'uses' => 'SeriesController@add_movie']);
    Route::delete('/series/{series_id}/remove_movie', [ 'as' => 'series.remove_movie', 'uses' => 'SeriesController@remove_movie']);

    Route::post('/plays/{play_id}/add_or_update_video', [ 'as' => 'plays.add_or_update_video', 'uses' => 'PlaysController@add_or_update_video']);
    Route::delete('/plays/{play_id}/remove_video', [ 'as' => 'plays.remove_video', 'uses' => 'PlaysController@remove_video']);
    Route::post('/plays/{play_id}/add_subtitle', [ 'as' => 'plays.add_subtitle', 'uses' => 'PlaysController@add_subtitle']);
    Route::delete('/plays/{play_id}/remove_subtitle', [ 'as' => 'plays.remove_subtitle', 'uses' => 'PlaysController@remove_subtitle']);

    Route::post('/products/{product_id}/add_image', [ 'as' => 'products.add_image', 'uses' => 'ProductsController@add_image']);
    Route::delete('/products/{product_id}/remove_image', [ 'as' => 'products.remove_image', 'uses' => 'ProductsController@remove_image']);
    Route::post('/products/{product_id}/update_featured_image', [ 'as' => 'products.update_featured_image', 'uses' => 'ProductsController@update_featured_image']);
    Route::post('/products/{product_id}/tag', [ 'as' => 'products.tag', 'uses' => 'ProductsController@tag']);
    Route::delete('/products/{product_id}/untag', [ 'as' => 'products.untag', 'uses' => 'ProductsController@untag']);
    Route::post('/products/{product_id}/add_category', [ 'as' => 'products.add_category', 'uses' => 'ProductsController@add_category']);
    Route::delete('/products/{product_id}/remove_category', [ 'as' => 'products.remove_category', 'uses' => 'ProductsController@remove_category']);
    Route::post('/products/{product_id}/add_tagged_plans', [ 'as' => 'products.add_tagged_plans', 'uses' => 'ProductsController@add_tagged_plans']);
    Route::post('/products/{product_id}/add_plan', [ 'as' => 'products.add_plan', 'uses' => 'ProductsController@add_plan']);
    Route::delete('/products/{product_id}/remove_plan', [ 'as' => 'products.remove_plan', 'uses' => 'ProductsController@remove_plan']);

    Route::post('/categories/{category_id}/add_product', [ 'as' => 'categories.add_product', 'uses' => 'CategoriesController@add_product']);
    Route::delete('/categories/{category_id}/remove_product', [ 'as' => 'categories.remove_product', 'uses' => 'CategoriesController@remove_product']);
    Route::patch('/categories/{category_id}/update_position', [ 'as' => 'categories.update_position', 'uses' => 'CategoriesController@update_position']);
    Route::patch('/categories/{category_id}/update_featured_image', [ 'as' => 'categories.update_featured_image', 'uses' => 'CategoriesController@update_featured_image']);

});

Route::group(['as' => 'front.', 'namespace' => 'Api\Front', 'prefix' => 'front'], function () {
    Route::get('/favourite', [ 'as' => 'favourite', 'uses' => 'FavouriteController@index']);
});