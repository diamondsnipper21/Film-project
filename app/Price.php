<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Underscore\Types\Arrays;
use Carbon\Carbon;

class Price extends Model
{
    protected $table = 'prices';

    const LIVE_DAYS_OPTIONS = [
        '3 days' => 3,
        '1 week' => 7,
        '1 month' => 30,
        '1 year' => 365,
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

}
