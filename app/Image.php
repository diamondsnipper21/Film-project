<?php

namespace App;
use Storage;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = ['url', 'width', 'height'];

 //    public function products()
 //    {
 //        return $this->morphedByMany('App\Product', 'imageable');
 //    }

 //    public function movies()
 //    {
 //        return $this->morphedByMany('App\Movie', 'imageable');
 //    }

 //    public function series()
 //    {
 //        return $this->morphedByMany('App\Series', 'imageable');
 //    }

    public static function create_from_uploaded_file($file)
    {
        $path = $file->store('images', 'public');

        $image = new Image();
        $image->size = Storage::disk('public')->size($path);
        $image->url = Storage::disk('public')->getConfig()->get('url') . '/' . $path;

        $image->save();
        
        return $image;
    }

    public static function create_from_local_file($path)
    {
        $path = Storage::disk('public')->putFile('images', new File($path));

        $image = new Image();
        $image->size =  Storage::disk('public')->size($path);
        $image->url = Storage::disk('public')->getConfig()->get('url') . '/'. $path;

        $image->save();

        return $image;
    }


}
