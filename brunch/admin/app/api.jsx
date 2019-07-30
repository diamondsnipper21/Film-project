import React from 'react';
import _ from 'underscore';

export default class Api {
    static headers() {
        return {
              'Accept': 'application/json',
              'Content-Type': 'application/json',
              'Authorization': 'Bearer ' +  Api.token(),
        };
    }
    static token() {
        return $('meta[name="token"]').attr('content');
    }

}

Api.images = {
    index(page){
        return fetch("/api/v1/images?page=" + page,  {
            method: 'GET',
            headers: Api.headers()
        });
    }
};

Api.subtitles = {
    index(page){
        return fetch("/api/v1/subtitles?page=" + page,  {
            method: 'GET',
            headers: Api.headers()
        });
    }
};

Api.videos = {
    index(page, quality){
        return fetch("/api/v1/videos?page=" + page + "&quality=" + quality, {
            method: 'GET',
            headers: Api.headers()
        });
    }
};

Api.movies = {
    index(page){
        return fetch("/api/v1/movies?page=" + page,  {
            method: 'GET',
            headers: Api.headers()
        });
    },
    add_image(movie_id, image_id){
        return fetch("/api/v1/movies/" + movie_id + "/add_image?image_id=" + image_id,  {
            method: 'POST',
            headers: Api.headers()
        });
    },
    remove_image(movie_id, image_id){
        return fetch("/api/v1/movies/" + movie_id + "/remove_image?image_id=" + image_id,  {
            method: 'DELETE',
            headers: Api.headers()
        });
    },
    update_featured_image(movie_id, image_id){
        return fetch("/api/v1/movies/" + movie_id + "/update_featured_image?image_id=" + image_id,  {
            method: 'POST',
            headers: Api.headers()
        });
    },
};

Api.series = {
    add_movie(series_id, movie_id){
        return fetch("/api/v1/series/" + series_id + "/add_movie?movie_id=" + movie_id,  {
            method: 'POST',
            headers: Api.headers()
        });
    },
    remove_image(series_id, image_id){
        return fetch("/api/v1/series/" + series_id + "/remove_image?image_id=" + image_id,  {
            method: 'DELETE',
            headers: Api.headers()
        });
    },
    add_image(series_id, image_id){
        return fetch("/api/v1/series/" + series_id + "/add_image?image_id=" + image_id,  {
            method: 'POST',
            headers: Api.headers()
        });
    },
    update_featured_image(series_id, image_id){
        return fetch("/api/v1/series/" + series_id + "/update_featured_image?image_id=" + image_id,  {
            method: 'POST',
            headers: Api.headers()
        });
    },
    remove_movie(series_id, movie_id){
        return fetch("/api/v1/series/" + series_id + "/remove_movie?movie_id=" + movie_id,  {
            method: 'DELETE',
            headers: Api.headers()
        });
    },
};

Api.plays = {
    add_or_update_video(play_id, quality, video_id){
        return fetch("/api/v1/plays/" + play_id + "/add_or_update_video?quality=" + quality + "&video_id=" + video_id,  {
            method: 'POST',
            headers: Api.headers()
        });
    },
    remove_video(play_id, video_id){
        return fetch("/api/v1/plays/" + play_id + "/remove_video?video_id=" + video_id,  {
            method: 'DELETE',
            headers: Api.headers()
        });
    },
    add_subtitle(play_id, subtitle_id){
        return fetch("/api/v1/plays/" + play_id + "/add_subtitle?subtitle_id=" + subtitle_id,  {
            method: 'POST',
            headers: Api.headers()
        });
    },
    remove_subtitle(play_id, subtitle_id){
        return fetch("/api/v1/plays/" + play_id + "/remove_subtitle?subtitle_id=" + subtitle_id,  {
            method: 'DELETE',
            headers: Api.headers()
        });
    },
};

Api.products = {
    index(page){
        return fetch("/api/v1/products?page=" + page,  {
            method: 'GET',
            headers: Api.headers()
        });
    },
    add_image(product_id, image_id){
        return fetch("/api/v1/products/" + product_id + "/add_image?image_id=" + image_id,  {
            method: 'POST',
            headers: Api.headers()
        });
    },
    remove_image(product_id, image_id){
        return fetch("/api/v1/products/" + product_id + "/remove_image?image_id=" + image_id,  {
            method: 'DELETE',
            headers: Api.headers()
        });
    },
    update_featured_image(product_id, image_id){
        return fetch("/api/v1/products/" + product_id + "/update_featured_image?image_id=" + image_id,  {
            method: 'POST',
            headers: Api.headers()
        });
    },
    tag(product_id, tag){
        return fetch("/api/v1/products/" + product_id + "/tag?tag=" + tag,  {
            method: 'POST',
            headers: Api.headers()
        });
    },
    untag(product_id, tag){
        return fetch("/api/v1/products/" + product_id + "/untag?tag=" + tag,  {
            method: 'DELETE',
            headers: Api.headers()
        });
    },
    add_category(product_id, category_slug){
        return fetch("/api/v1/products/" + product_id + "/add_category?category=" + category_slug,  {
            method: 'POST',
            headers: Api.headers()
        });
    },
    remove_category(product_id, category_slug){
        return fetch("/api/v1/products/" + product_id + "/remove_category?category=" + category_slug,  {
            method: 'DELETE',
            headers: Api.headers()
        });
    },
    add_plan(product_id, plan_id){
        return fetch("/api/v1/products/" + product_id + "/add_plan?plan_id=" + plan_id,  {
            method: 'POST',
            headers: Api.headers()
        });
    },
    add_tagged_plans(product_id, tag){
        return fetch("/api/v1/products/" + product_id + "/add_tagged_plans?tag=" + tag,  {
            method: 'POST',
            headers: Api.headers()
        });
    },
    remove_plan(product_id, plan_id){
        return fetch("/api/v1/products/" + product_id + "/remove_plan?plan_id=" + plan_id,  {
            method: 'DELETE',
            headers: Api.headers()
        });
    },
};

Api.categories = {
    add_product(category_id, product_id){
        return fetch("/api/v1/categories/" + category_id + "/add_product?product_id=" + product_id,  {
            method: 'POST',
            headers: Api.headers()
        });
    },
    remove_product(category_id, product_id){
        return fetch("/api/v1/categories/" + category_id + "/remove_product?product_id=" + product_id,  {
            method: 'DELETE',
            headers: Api.headers()
        });
    },
    update_position(category_id, target_category_id){
        return fetch("/api/v1/categories/" + category_id + "/update_position?target_category_id=" + target_category_id,  {
            method: 'PATCH',
            headers: Api.headers()
        });
    },
    update_featured_image(category_id, image_id){
        return fetch("/api/v1/categories/" + category_id + "/update_featured_image?image_id=" + image_id,  {
            method: 'PATCH',
            headers: Api.headers()
        });
    }
};
