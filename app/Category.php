<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use \Rutorika\Sortable\SortableTrait;
    
    protected $table = 'categories';

    protected $appends = ['featured_image', 'featured_image_url'];

    public function images()
    {
        return $this->morphToSortedMany('App\Image', 'imageable');
    }

    // required for morphToSortedMany
    protected function getBelongsToManyCaller(){
        return 'images';
    }
    
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function getCategoryNames()
    {
    	return $this->pluck('name');
    }

    public function featured_image()
    {
        return $this->belongsTo('App\Image', 'featured_image_id');
    }

    public function featured_image_url()
    {
        if ($this->featured_image == null)
            return '';

        return $this->featured_image->url;
    }

    public function getFeaturedImageAttribute()
    {
        return $this->featured_image()->first();
    }

    public function getFeaturedImageUrlAttribute()
    {
        return $this->featured_image_url();
    }

    public function years()
    {
        $years = $this->products->pluck('year')->unique()->sort()->all();
        return $years;
    }

}
