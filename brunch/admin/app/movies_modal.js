import ReactDOM from 'react-dom';
import React from 'react';
import Thumbnails from 'components/movie/Thumbnails';
import MovieList from 'components/series/MovieList';

export default class MoviesModal{

    load_movies()
    {
		ReactDOM.render(<MovieList />, $('#movieList')[0]);
    }

}
