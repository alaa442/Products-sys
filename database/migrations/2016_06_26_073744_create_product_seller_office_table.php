<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSellerOfficeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
                Schema::create('product_selleroffice', function (Blueprint $table) {
          $table->softDeletes();

       $table->integer('product_id')->unsigned();
            $table->integer('selleroffice_id')->unsigned();
 

            $table->foreign('product_id')
                  ->references('id')->on('product')
                  ->onDelete('cascade')
                  ->onupdate('cascade');
            $table->foreign('selleroffice_id')
                  ->references('id')->on('selleroffice')
                  ->onDelete('cascade')
                  ->onupdate('cascade');

                 
                 
             $table->primary(['product_id', 'selleroffice_id']);
    }); }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
