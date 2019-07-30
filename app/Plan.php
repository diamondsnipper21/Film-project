<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subscription;
use App\Product;
use Conner\Tagging\Taggable;
use Carbon\Carbon;

class Plan extends Model
{
	use Taggable;

	protected $appends = ['tag_names', 'formatted_name'];

    public function subscriptions()
    {
        return $this->hasMany('App\Subscription');
    }

	public function create_subscription()
	{		
		$subscription = new Subscription([
			'plan_id' => $this->id,
			'trail_ends_at' => Carbon::now()->addDays( intval($this->trial_days) ),
			'ends_at' => Carbon::now()->addDays( intval($this->trial_days) + intval($this->period_days) ),
			]);

		$subscription->save();

		return $subscription;
	}

	public static function by_name($name)
	{
		Plan::where('name', $name)->first();
	}

    public function getTagNamesAttribute()
    {
        return $this->tagNames();
    }

    public function getFormattedNameAttribute()
    {
        return $this->name . ' (' . implode($this->tagNames(), ',') . ')';
    }
}
