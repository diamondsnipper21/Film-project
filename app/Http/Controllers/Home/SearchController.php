<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Category;
use App\Movie;

class SearchController extends HomeController
{
	public function __construct()
    {
        //Category::find()
    }
    public function show(Request $request)
    {   
        $categories = Category::all(); 	
        if(!empty($request->input('c')))
        {
            $category_ids = explode('-', $request->input('c'));    
        }
        else
        {
            $category_ids = array_pluck($categories, 'id');
        }

        $keyword = $request->input('k');        
        $search_result = [];
        $movies = [];

        if (!empty($request->input('s'))) {
            $sort = explode('-', $request->input('s'));            
            $sort_field = 'title';
            $sort_direction = $sort[1];
        }
        else
        {
            $sort_field = 'title';
            $sort_direction = 'asc';            
        }
        
        foreach($categories as $category)
        {
            if(in_array($category->id, $category_ids))
            {
                $movies = $category->movies()->where('title', 'like', '%'.$keyword.'%')->orderBy($sort_field, $sort_direction)->get();                                                        
                $search_result[$category->name] = $movies;                    
            }                  
     
        }
    	return view('pages/search_result', ['sort' => $request->input('s'), 'search_result' => $search_result, 'keyword' => $keyword, 'selected_categories' => $category_ids]);    	
	}
}