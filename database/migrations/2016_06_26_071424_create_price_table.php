<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create('price', function (Blueprint $table) {
          $table->increments('id')->unsigned();
          $table->date('date');
          $table->string('goverment', 32);
          $table->string('city', 32);
           $table->timestamps();

                  $table->softDeletes();

             $table->integer('product_id')->unsigned();
             $table->foreign('product_id')
              ->references('id')->on('product')
              ->onDelete('cascade')
              ->onupdate('cascade');
 });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('price');
    }
}
