import React from 'react';
import Api from 'api';
import Placeholder from 'placeholder';
import MovieList from 'components/series/MovieList';

export default class Movie extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            error: null,
            series_id: props.series_id,
            items: props.movies,
        };
        this.onMovieRemove = this.onMovieRemove.bind(this);
    }

    componentDidMount() {
        MovieList.onMovieSelected = this.handleSelectedMovie.bind(this);
    }

    handleSelectedMovie(movie, e){
        $('.modal').modal('hide');

        Api.series.add_movie(this.state.series_id, movie.id)
        .then(res => res.json())
        .then(
            (result) => {
                this.setState({
                    items: result,
                });
            },
            (error) => {
                this.setState({
                    isLoaded: true,
                    error
                });
            }
        )
    }

    onMovieRemove(movie_id, e) {
        Api.series.remove_movie(this.state.series_id, movie_id)
        .then(res => res.json())
        .then(
            (result) => {
                this.setState({
                    items: result,
                });
            },
            (error) => {
                this.setState({
                    isLoaded: true,
                    error
                });
            }
        )
    }

    render() {
        const { error, items } = this.state;
        return (
            <div className="gallery gallery-widget">
                <div className="row text-center">
                    {items.map((item, index) => (
                        <div className="col-sm-2" key={item.id}>
                            <a href={"/admin/movies/" + item.id + "/edit"} >
                                <img src={ item.featured_image_url || Placeholder.video.md } alt="Movie" />
                            </a>
                            <a href="javascript:void(0)" className="btn btn-danger btn-sm" onClick={(e)=>this.onMovieRemove(item.id, e)}>
                                <i className="fa fa-trash">&nbsp;REMOVE</i>
                            </a>
                        </div>
                    ))}

                    <div className="col-sm-2">
                        <a href="javascript: void(0);" data-toggle="modal" data-target="#movieModal" title="Add" className="btn btn-primary">
                            <i className="fa fa-plus">Add New Movie</i>
                        </a>
                    </div>
                </div>
            </div>
        );
    }
}
