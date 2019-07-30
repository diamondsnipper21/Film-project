import React from 'react';
import _ from 'underscore';
export default class Favourite extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            error: null,
            isLoaded: false,
            items: [],
            params: props.params
        };
    }

    componentDidMount() {
        this.setState({isLoaded: false});    
        const { error, isLoaded, items, params } = this.state;
        fetch("/api/front/favourite"+"?movie_id="+params.movie_id+"&user_id="+params.user_id+"&AddOrRemove="+params.addorremove_flag)
        .then(res => res.json())
        .then(
            (result) => {
                this.setState({
                    isLoaded: true,
                    items: result.data,
                    data: result
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

    render() {
        const { error, isLoaded, items, data } = this.state;
        if (error) {
            return <div>Error: {error.message}</div>;
        } else if (!isLoaded) {
            return <div>Waiting...</div>;
        } else {
            return (
                <label id="favourite" class="switch switch-primary" data-toggle="tooltip" title={item.type == 0? 'Remove from Wish List':'Add to Wish List'}>
                    <i class="fa {{ (item.success==0?'':'fa-heart') }} {{ in_array($movie->id, $favourite_movies) == true? 'text-danger':'text-muted'}}"></i>
                    <span></span>
                </label> 
            );
        }
    }
}
