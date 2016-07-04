<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('goverment', 32);
            $table->string('city', 32);
            $table->date('start_date');
            $table->integer('duration');
            $table->string('activity_type', 32);
            $table->string('description', 32)->nullable();
            $table->binary('img')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')
                ->references('id')->on('company')
                ->onDelete('cascade')
                ->onupdate('cascade');

            $table->unique(array('goverment', 'city', 'activity_type','duration'));

        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
                Schema::drop('activity');
    }
}
