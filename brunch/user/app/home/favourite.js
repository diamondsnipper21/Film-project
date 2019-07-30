import ReactDOM from 'react-dom';
import React from 'react';
import Favourite from 'home/components/Favourite';
import jQuery from 'jquery';

function addorremove(movie_id, user_id, addorremove_flag) {
	const params = [{movie_id: movie_id, user_id: user_id, addorremove_flag:addorremove_flag}];
  	ReactDOM.render(<Favourite params = {params}/>, document.querySelector('#favourite'));
}
 
jQuery(function(){
// Function to add event listener to table
$("#btn_heart").on({click: function(){
	var movie_id = $(this).attr('movie-id');
	var user_id = $(this).attr('user-id');
	var addorremove_flag = ($(this).children(0).hasClass('text-danger'));
	addorremove(movie_id, user_id, !addorremove_flag);
}});
});
