import ReactDOM from 'react-dom';
import React from 'react';
import Thumbnails from 'components/product/Thumbnails';

export default class ProductsEdit{

    init(product) {
        this.init_images(product);
	}

    init_images(product) {
        ReactDOM.render(<Thumbnails product_id={product.id} images={product.images} featured_image={product.featured_image} />, $('#thumbnailList')[0]);
    }

}
