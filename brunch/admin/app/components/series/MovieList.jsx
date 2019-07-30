import React from 'react';
import _ from 'underscore';
import Api from 'api';
import ReactPaginate from 'components/paginate/PaginationBoxView'
import Placeholder from 'placeholder';

export default class MovieList extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            error: null,
            items: [],
            data: {}
        };
        this.handlePageClick = this.handlePageClick.bind(this);
    }

    loadMovies(page){
        $('#movie-list').block({message: 'Loading, please wait...'});
        return Api.movies.index(page)
        .then(res => res.json())
        .then(
            (result) => {
                $('#movie-list').unblock();
                this.setState({
                    items: result.data,
                    data: result
                });
            },
            (error) => {
                this.setState({
                    error
                });
            }
        )
    }

    handlePageClick(page) {
        this.loadMovies(page.selected + 1);    
    }

    componentDidMount() {
        this.loadMovies(1);
    }

    render() {
        const { error, items, data } = this.state;
        if (error) {
            return <div>Error: {error.message}</div>;
        } else {
            if(items.length == 0)
                return null;

            return (
                <div className="text-center">

                    <div className="row">
                    {items.map((item, index) => (
                        [<div className="col-sm-4" key={item.id}>
                            <a href="javascript:void(0)" className="thumbnail widget widget-hover-effect1">
                                <img src={item.featured_image_url || Placeholder.video.md } alt="Movie" onClick={(e)=>MovieList.onMovieSelected(item, e)}/>
                            </a>
                        </div>,
                        <div className={index % 3 !=2 ? 'hidden' : ''}>
                            <div className="clearfix"></div>
                        </div>
                        ]
                    ))}
                    </div>

                    <ReactPaginate previousLabel={"«"}
                       nextLabel={"»"}
                       breakLabel={<a href="">...</a>}
                       breakClassName={"break-me"}
                       pageCount={data.last_page}
                       marginPagesDisplayed={2}
                       pageRangeDisplayed={3}
                       onPageChange={this.handlePageClick}
                       containerClassName={"pagination"}
                       subContainerClassName={"pages pagination"}
                       activeClassName={"active"} />
                   
                </div>
            );
        }
    }
}

MovieList.onMovieSelected = function(){};
