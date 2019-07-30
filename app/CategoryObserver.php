<?php

namespace App;

use App\Category;

class CategoryObserver
{
    public function created(Category $category)
    {
        $category->update(['slug' => $this->get_slug($category->name)]);
    }

    // it should be replaced cvierbrock's Eloquent-Sluggable package
    public function get_slug($name) {
        $slug = str_slug($name);
        $slug_count = count( Category::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );
        return ($slug_count > 0) ? "{$slug}-{$slug_count}" : $slug;
    }

    public function deleting(Category $category)
    {
        $category->products()->detach();
    }
}
