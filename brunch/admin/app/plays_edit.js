import ReactDOM from 'react-dom';
import React from 'react';
import VideoList from 'components/VideoList';
import Subtitles from 'components/play/Subtitles';
import Videos from 'components/play/Videos';

export default class PlaysEdit{

    init(play, qualitys)
    {
        this.load_subtitles(play);
        this.load_videos(play, qualitys);
    }

    load_subtitles(play)
    {
        ReactDOM.render(<Subtitles play_id={play.id} subtitles={play.subtitles}/>, $('#subtitles')[0]);
    }

    load_videos(play, qualitys)
    {
        ReactDOM.render(<Videos play_id={play.id} videos={play.videos} qualitys={qualitys} />, $('#videos')[0]);
    }

}
