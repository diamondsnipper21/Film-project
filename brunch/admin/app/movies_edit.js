import ReactDOM from 'react-dom';
import React from 'react';
import Thumbnails from 'components/movie/Thumbnails';
import MovieList from 'components/series/MovieList';

export default class MoviesEdit{

    init(movie, images) {
        this.init_images(movie);
	}

    init_images(movie) {
        ReactDOM.render(<Thumbnails movie_id={movie.id} images={movie.images} featured_image={movie.featured_image} />, $('#thumbnailList')[0]);
    }

}
