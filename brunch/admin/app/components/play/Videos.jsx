import React from 'react';
import _ from 'underscore';
import Api from 'api';
import VideoList from 'components/VideoList';
import Placeholder from 'placeholder';
import VideosShow from 'videos_show';

export default class Videos extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            error: null,
            play_id: props.play_id,
            items: props.videos,
            qualitys: props.qualitys, 
        };
    }

    componentDidMount() {
        VideoList.onVideoSelected = this.handleSelectedVideo.bind(this);
    }

    onVideoSelect(quality){
        VideoList.quality = quality;

        Videos.page.unload_videos();
        Videos.page.load_videos();
    }

    handleSelectedVideo(video, e){
        $('.modal').modal('hide');

        Api.plays.add_or_update_video(this.state.play_id, VideoList.quality, video.id)
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

    onVideoRemove(video_id) {
        Api.plays.remove_video(this.state.play_id, video_id)
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
        const { error, play_id, items, qualitys } = this.state;
        if (error) {
            return <div>Error: {error.message}</div>;
        } else {

            let videos = [];
            for (let i = 0; i < qualitys.length; i ++)
            {
                videos[i] = null;
                for (let j = 0; j < items.length; j ++)
                    if(qualitys[i] == items[j].quality)
                    {
                        videos[i] = items[j];
                        break;
                    }
            }

            return (
                <table className="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th className="col-sm-2">Resolution</th>
                            <th className="col-sm-2">Featured</th>
                            <th className="">Name</th>
                            <th className="">Duration</th>
                            <th className=""></th>
                        </tr>
                    </thead>
                    <tbody>
                    {videos.map((item, index) => (
                        <tr key={qualitys[index]}>
                            <td>{ qualitys[index] }</td>
                            <td>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#videoModal" title="Add" className="thumbnail widget widget-hover-effect1">
                                    <img src={ item!=null ? item.featured_image_url : Placeholder.video.md } alt="featured" onClick={this.onVideoSelect.bind(this, qualitys[index])} />
                                </a>
                            </td>

                            { (item != null) ? (
                                [<td key="name">{ item.name }</td>,
                                <td key="duration">{ item.duration }</td>,
                                <td key="action">
                                    <a href="javascript:void(0)" className="btn btn-danger btn-sm" onClick={this.onVideoRemove.bind(this, item.id)}>
                                        <i className="fa fa-trash"></i>
                                    </a>
                                </td>]
                            ):(
                                [<td key="name"></td>,
                                <td key="duration"></td>,
                                <td key="action"></td>]
                            ) }
                        </tr>
                    ))}
                    </tbody>
                </table>
            );
        }
    }
}

Videos.page = new VideosShow();
