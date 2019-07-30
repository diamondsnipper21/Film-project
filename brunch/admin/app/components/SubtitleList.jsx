import React from 'react';
import _ from 'underscore';
import Api from 'api';
import ReactPaginate from 'components/paginate/PaginationBoxView'

export default class SubtitleList extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            error: null,
            items: [],
            data: {}
        };
        this.handlePageClick = this.handlePageClick.bind(this);
    }

    loadSubtitles(page){
        $('#subtitle-list').block({message: 'Loading, please wait...'});
        Api.subtitles.index(page)
        .then(res => res.json())
        .then(
            (result) => {
                $('#subtitle-list').unblock();
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
        this.loadSubtitles(page.selected + 1);    
    }

    componentDidMount() {
        this.loadSubtitles(1);
    }

    render() {
        const { error, items, data } = this.state;
        if (error) {
            return <div>Error: {error.message}</div>;
        } else {

            return (
                <div>
                    <table className="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th className="col-sm-1">No</th>
                                <th className="col-sm-2">language</th>
                                <th className="">url</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {items.map((item, index) => (
                                <tr key={item.id}>
                                    <td>{ index+1 }</td>
                                    <td>{ item.language }</td>
                                    <td>{ item.url }</td>
                                    <td>
                                        <a href="javascript:void(0)" className="btn btn-primary" onClick={(e)=>SubtitleList.onSubtitleSelected(item, e)}>
                                            <i className="fa fa-check-circle"></i>
                                        </a>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>

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

SubtitleList.onSubtitleSelected = function(){};
