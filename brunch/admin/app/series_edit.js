import ReactDOM from 'react-dom';
import React from 'react';
import Thumbnails from 'components/series/Thumbnails';
import Movies from 'components/series/Movies';

export default class SeriesEdit{

	init(series) {
		this.init_images(series);
        this.init_movies(series);
	}

    init_images(series) {
    	ReactDOM.render(<Thumbnails series_id={series.id} images={series.images} featured_image={series.featured_image} />, $('#thumbnailList')[0]);
    }

    init_movies(series) {
    	ReactDOM.render(<Movies series_id={series.id} movies={series.movies} />, $('#movies')[0]);
    }

}
