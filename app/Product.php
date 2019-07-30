<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Underscore\Types\Arrays;
use Carbon\Carbon;
use Conner\Tagging\Taggable;

class Product extends Model
{
    use \Rutorika\Sortable\MorphToSortedManyTrait;
    
    use Taggable;
    
    protected $table = 'products';

    protected $appends = ['images', 'featured_image', 'featured_image_url'];

    public function productable()
    {
        return $this->morphTo();
    }

    public function type()
    {
        return str_slug(class_basename($this->productable_type));
    }

    public static function years()
    {
        return Product::orderBy('year', 'desc')->pluck('year')->unique()->except(null);
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function plans()
    {
        return $this->belongsToMany('App\ProductPlan');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function category_names()
    {
        return $this->categories()->pluck('name');
    }

    public function formatted_category_names()
    {
        return implode($this->categories()->pluck('name')->toArray(), ',');
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

    public function images()
    {
        return $this->morphToSortedMany('App\Image', 'imageable');
    }

    // required for morphToSortedMany
    protected function getBelongsToManyCaller(){
        return 'images';
    }

    public function duration_in_minutes()
    {
        $time1 = Carbon::today();
        $time2 = Carbon::today();
        
        $time1->addSeconds($this->duration);

        return $time2->diffInMinutes($time1);
    }

    public function rating()
    {
        return round($this->reviews->sum('score') / $this->reviews->count(), 1);
    }

    public function related_products()
    {
        return $this->categories->first()->products;
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