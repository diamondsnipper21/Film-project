import ReactDOM from 'react-dom';
import React from 'react';
import VideoList from 'components/VideoList';

export default class VideosShow{
    load_videos(){
        ReactDOM.render(<VideoList />, $('#videoList')[0]);
    }

    unload_videos(){
        ReactDOM.unmountComponentAtNode($('#videoList')[0]);       
    }
}
