<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Subscription extends Model
{
    const STATUSES = ['cancelled', 'expired', 'active'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function onTrial()
    {
        return Carbon::now()->lessThan(new Carbon($this->trial_ends_at));
    }

    public function cancelled()
    {
        return $this->status == 'cancelled';
    }

    public function expired()
    {
        return Carbon::now()->greaterThan(new Carbon($this->ends_at));
    }

    public function onGracePeriod()
    {
        return $this->cancelled() && !$this->expired();
    }

    public function skipTrial()
    {
        $this->trial_ends_at = null;
        require $this;
    }

    public function swap($plan_id)
    {
        $plan = Plan::find($plan_id);
        
        $this->plan_id = $plan->id;
        $this->plan_name = $plan->name;
        $this->plan_type = $plan->type;

        $this->save();
    }

    public function incrementQuantity($quantity = 1)
    {
        $this->quantity += $quantity;
        $this->save();
    }

    public function decrementQuantity($quantity = 1)
    {
        $this->quantity -= $quantity;
        $this->save();
    }

    public function updateQuantity($quantity)
    {
        $this->quantity = $quantity;
        $this->save();
    }

    public function cancel()
    {
        $this->status = 'cancelled';
        $this->save();
    }

    public function resume()
    {
        if($this->cancelled())
        {
            $this->status = 'active';
            $this->save();
        }
    }

    public function trialDays($days)
    {
        $this->trial_ends_at = Carbon::now()->addDays($days);
        $this->save();
    }

}
