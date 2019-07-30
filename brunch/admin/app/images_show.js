import ReactDOM from 'react-dom';
import React from 'react';
import ImageList from 'components/ImageList';

export default class ImagesShow{

    load_images(){
        ReactDOM.render(<ImageList/>, $('#imageList')[0]);
    }

    unload_images(){
        ReactDOM.unmountComponentAtNode($('#imageList')[0]);       
    }
}
