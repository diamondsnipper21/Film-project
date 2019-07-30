import React from 'react';
import _ from 'underscore';
import Api from 'api';
import SubtitleList from 'components/SubtitleList';

export default class Subtitles extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            error: null,
            play_id: props.play_id,
            items: props.subtitles,
        };
    }

    componentDidMount() {
        SubtitleList.onSubtitleSelected = this.handleSelectedSubtitle.bind(this);
    }

    handleSelectedSubtitle(subtitle, e){
        $('.modal').modal('hide');

        Api.plays.add_subtitle(this.state.play_id, subtitle.id)
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

    onSubtitleRemove(subtitle_id, e) {
        Api.plays.remove_subtitle(this.state.play_id, subtitle_id)
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
        const { error, play_id, items } = this.state;
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
                                        <a href="javascript:void(0)" className="btn btn-danger btn-sm" onClick={(e)=>this.onSubtitleRemove(item.id, e)}>
                                            <i className="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colSpan="4">
                                    <a href="javascript:void(0)" className="btn btn-primary" data-toggle="modal" data-target="#subtitleModal" >
                                        <i className="fa fa-plus"></i>
                                    </a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            );
        }
    }
}
