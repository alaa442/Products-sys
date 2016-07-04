<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerofficeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('selleroffice', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('goverment', 32);
            $table->string('city', 32);
            $table->integer('telephone')->unique();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')
                ->references('id')->on('company')
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
                        Schema::drop('selleroffice');
    }
}
