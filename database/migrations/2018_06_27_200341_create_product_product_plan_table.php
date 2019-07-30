<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductProductPlanTable extends Migration
{
    public function up()
    {
        Schema::create('product_product_plan', function (Blueprint $table) {
            $table->integer('product_id')->nullable();
            $table->integer('product_plan_id')->nullable();

            $table->index(['product_id', 'product_plan_id']);
        });
    }

    public function down()
    {
         Schema::dropIfExists('product_product_plan');
    }
}
