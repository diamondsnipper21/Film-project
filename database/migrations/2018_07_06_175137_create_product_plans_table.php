<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPlansTable extends Migration
{
    public function up()
    {
        Schema::create('product_plans', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('description')->nullable();
            $table->integer('price_cents')->nullable();
            $table->integer('period_days')->nullable();
            $table->integer('trial_days')->nullable();
            $table->timestamps();

            $table->index(['id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_plans');
    }
}
