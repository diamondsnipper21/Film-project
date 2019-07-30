<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('product_subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('product_plan_id')->nullable();
            
            $table->integer('quantity')->nullable();
            $table->string('status')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();

            $table->index(['id', 'user_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_subscriptions');
    }
}
