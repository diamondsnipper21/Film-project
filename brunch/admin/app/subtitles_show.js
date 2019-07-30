import ReactDOM from 'react-dom';
import React from 'react';
import SubtitleList from 'components/SubtitleList';

export default class SubtitlesShow{

    load_subtitles(){
        ReactDOM.render(<SubtitleList/>, $('#subtitleList')[0]);
    }

    unload_subtitles(){
        ReactDOM.unmountComponentAtNode($('#subtitleList')[0]);
    }
}
