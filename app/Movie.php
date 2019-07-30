<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Movie extends Model
{
    use \Rutorika\Sortable\MorphToSortedManyTrait;

    protected $table = 'movies';

    protected $appends = ['images', 'featured_image', 'featured_image_url'];

    public function create_product()
    {
        $product = new Product();
        $product->name = $this->title;
        $product->description = $this->description;
        $product->year = $this->year;
        $product->make = $this->make;
        $product->duration = $this->duration;
        $product->featured_image_id = $this->images->first()->id;

        $this->product()->save($product);

        if(count($this->images))
        {
            $images = [];
            foreach($this->images as $image){
                $image = collect($image)->only('url', 'width', 'height')->toArray();
                array_push($images, new Image($image));
            }

            $product->images()->saveMany($images);
        }

        return $product;
    }

    public function is_product()
    {
        return $this->product != null;
    }

    public function product()
    {
        return $this->morphOne('App\Product', 'productable');
    }

    public function series()
    {
        return $this->belongsTo('App\Series');
    }

    public function play()
    {
        return $this->hasOne('App\Play');
    }

    public function images()
    {
        return $this->morphToSortedMany('App\Image', 'imageable');
    }

    // required for morphToSortedMany
    protected function getBelongsToManyCaller(){
        return 'images';
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

    public function preview_play()
    {
        return $this->morphOne('App\Play', 'playable');
    }

    public function casts()
    {
        return $this->hasMany('App\Cast');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function getImagesAttribute()
    {
        return $this->images()->get();
    }

    public function getFeaturedImageAttribute()
    {
        return $this->featured_image()->first();
    }

    public function getFeaturedImageUrlAttribute()
    {
        return $this->featured_image_url();
    }

}
