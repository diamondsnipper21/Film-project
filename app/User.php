<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Subscription;
use App\Charge;
use Conner\Tagging\Taggable;

class User extends Authenticatable
{
    protected $table = 'users';

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'plan_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function movies()
    {
        return $this->belongsToMany('App\Movie');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Subscription');
    }

    public function subscription($plan_name)
    {
        return $this->subscriptions()->where('plan_name', $plan_name)->first();
    }

    public function subscription_by($plan_name, $plan_type)
    {
        return $this->subscriptions()
                    ->where(['plan_name' => $plan_name, 'plan_type' => $plan_type])
                    ->first();
    }

    public function newSubscription($plan_id)
    {
        $plan = Plan::find($plan_id);
        $subscription = $plan->create_subscription();

        $this->subscriptions()->save($subscription);

        return $subscription;
    }

    public function subscribed($plan_name)
    {
        $subscription = $this->subscription($plan_name);

        if ($subscription == null)
        {
            return false;
        }

        return !$subscription->expired();
    }

    public function subscribedToPlan($plan_type, $plan_name)
    {
        $subscription = $this->subscription_by($plan_name, $plan_type);

        if ($subscription == null)
        {
            return false;
        }
        
        return !$subscription->expired();
    }

    public function onTrial($plan_name)
    {
        return $this->subscription($plan_name)->onTrial();
    }

    public function onGenericTrial()
    {
        return count($this->subscriptions()) == 0;
    }
    
    public function charge($cents, $product_id)
    {
        $payment = new Payment([
            'product_id' => $product_id,
            'total_price_cents' => $cents,
            ]);

        $this->payments()->save($payment);

        return $payment;
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function downloadInvoice($payment_id)
    {
    }
}
