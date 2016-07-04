<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promoter', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('Pormoter_Name',120)->unique()->nullable();
            $table->integer('TelephonNo')->unique()->nullable();
            $table->string('Government',150)->nullable();
            $table->string('City',150)->nullable();
            $table->string('Email',200)->unique()->nullable();

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
        Schema::drop('promoter');
    }
}
