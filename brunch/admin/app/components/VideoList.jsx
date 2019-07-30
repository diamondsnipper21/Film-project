import React from 'react';
import _ from 'underscore';
import Api from 'api';
import ReactPaginate from 'components/paginate/PaginationBoxView'

export default class VideoList extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            error: null,
            items: [],
            data: {},
        };
        this.handlePageClick = this.handlePageClick.bind(this);
    }

    loadVideos(page){
        $('#video-list').block({message: 'Loading, please wait...'});
        Api.videos.index(page, VideoList.quality)
        .then(res => res.json())
        .then(
            (result) => {
                $('#video-list').unblock();
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
        this.loadVideos(page.selected + 1);
    }

    componentDidMount() {
        this.loadVideos(1);
    }

    render() {
        const { error, items, data } = this.state;
        if (error) {
            return <div>Error: {error.message}</div>;
        } else {
            let pages = _.range(data.last_page);
            
            return (
                <div className="text-center">

                    <div className="row">
                    {items.map((item, index) => (
                        [<div className="col-sm-4" key={item.id}>
                            <a href="javascript:void(0)" className="thumbnail widget widget-hover-effect1">
                                <img src={item.featured_image ? item.featured_image.url : ''} height="49px" alt="Video" onClick={(e)=>VideoList.onVideoSelected(item, e)}/>
                                <span>{item.name}, {item.quality}, {item.duration} </span>
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

VideoList.onVideoSelected = function(){};
VideoList.quality = null;
