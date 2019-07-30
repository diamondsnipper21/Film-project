<?php

use Illuminate\Database\Seeder;
use App\Plan;

class PlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$gateway_free_plan = new Plan([
    		'name' => 'free',
            'price_cents' => 0, 
            'period_days' => 30, 
            'trial_days' => 30, 
    		]);

    	$gateway_pro_plan = new Plan([
    		'name' => 'pro', 
            'price_cents' => 2000, 
            'period_days' => 30, 
            'trial_days' => 30, 
    		]);

    	$gateway_ultra_plan = new Plan([
    		'name' => 'ultra', 
            'price_cents' => 3000, 
            'period_days' => 30, 
            'trial_days' => 30, 
    		]);


    	$gateway_free_plan->save();
    	$gateway_pro_plan->save();
    	$gateway_ultra_plan->save();
    }
}
