<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('series_id')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->integer('order')->nullable();
            $table->integer('watched')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('year')->nullable();
            $table->string('make')->nullable();
            $table->integer('featured_image_id')->nullable();
            $table->timestamps();

            $table->index(['id','series_id', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
