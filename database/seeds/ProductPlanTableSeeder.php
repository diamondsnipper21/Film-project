<?php

use Illuminate\Database\Seeder;
use App\Plan;

class ProductPlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_bronze_plan = new ProductPlan([
            'name' => 'bronze', 
            'price_cents' => 100, 
            'period_days' => 3,
            ]);

        $product_silver_plan = new ProductPlan([
            'name' => 'product', 
            'price_cents' => 200,
            'period_days' => 7,
            ]);

        $product_gold_plan = new ProductPlan([
            'name' => 'gold', 
            'price_cents' => 300, 
            'period_days' => 30, 
            ]);


        $product_bronze_plan->save();
        $product_silver_plan->save();
        $product_gold_plan->save();
    }
}
