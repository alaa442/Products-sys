<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('company', function (Blueprint $table) {
          $table->increments('id')->unsigned();
          $table->string('name', 32)->unique();
          $table->string('goverment', 32);
          $table->string('city', 32);
          $table->softDeletes();

          
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
                Schema::drop('company');
    }
}
