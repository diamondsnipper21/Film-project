import React from 'react';
export default class Series extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            error: null,
            movie_id: props.movie_id,
            items: props.series,
        };
        this.onSeriesDelete = this.onSeriesDelete.bind(this);
    }

    onSeriesDelete(series_id, e) {
        fetch("/api/v1/movies/" + this.state.movie_id + "/delete_series?series_id=" + series_id,  {
            method: 'DELETE',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json',
              'Authorization': 'Bearer ' +  $('meta[name="token"]').attr('content'),
            }
        })
        .then(res => res.json())
        .then(
            (result) => {
                this.setState({
                    items: result,
                });
            },
            // Note: it's important to handle errors here
            // instead of a catch() block so that we don't swallow
            // exceptions from actual bugs in components.
            (error) => {
                this.setState({
                    isLoaded: true,
                    error
                });
            }
        )
    }


    componentDidMount() {
    }
/*
    handleSelectedSeries(series, e){

        fetch("/api/v1/movies/" + this.state.movie_id + "/add_series",  {
            method: 'POST',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json',
              'Authorization': 'Bearer ' + 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly93d3cuZmlsbS5jb20vYXBpL3Rva2VuIiwiaWF0IjoxNTI2MDMzMTcwLCJleHAiOjE1MjYwMzY3NzAsIm5iZiI6MTUyNjAzMzE3MCwianRpIjoidU1nd1dRNWphazdtWXM2WSJ9.FPuG4a0F95dh_W0tAm20Wo3EbLkUEd1ZS-9gFmDlz6M',
            }
        })
        .then(res => res.json())
        .then(
            (result) => {
                this.setState({
                    items: result,
                });
            },
            // Note: it's important to handle errors here
            // instead of a catch() block so that we don't swallow
            // exceptions from actual bugs in components.
            (error) => {
                this.setState({
                    isLoaded: true,
                    error
                });
            }
        )
    }*/

    render() {
        const { error, items } = this.state;

        return (
            <div className="row text-center">
                {items.map((item, index) => (
                    <div className="col-sm-2" key={item.id}>
                        <a href={"/admin/movies/" + this.state.movie_id + "/series/" + item.id + "/edit"} className="widget widget-hover-effect1">
                            {item.images && item.images.length > 0 ?(                            
                                <img src={item.images[0].url} height="149px" className="img-thumbnail" />
                            ):(
                                <img src="/img/placeholders/photos/photo1.jpg" height="149px" className="img-thumbnail" />
                            )}
                        </a>
                        <a href="javascript:void(0)" className="btn btn-danger btn-sm" onClick={(e)=>this.onSeriesDelete(item.id, e)}>
                            <span className="fa fa-trash">&nbsp;REMOVE</span>
                        </a>
                    </div>
                ))}

                <div className="col-sm-2">
                    <a href="javascript:void(0)" className="widget widget-hover-effect4" data-toggle="modal" data-target="#seriesModal">
                        <p><strong>Add New Series</strong></p>
                    </a>
                </div>
            </div>
        );
    }
}
