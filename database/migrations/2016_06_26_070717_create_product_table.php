<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('cement_name', 32);
            $table->float('weight');
            $table->float('rank');

            $table->string('specifications', 32)->nullable();
            $table->date('producation_date');
            $table->date('packing_date')->nullable();
            $table->string('guidlines', 32)->nullable();
            $table->string('security', 32)->nullable();
            $table->string('others', 32)->nullable();
            $table->binary('frontimg')->nullable();
            $table->binary('backimg')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')
                ->references('id')->on('company')
                ->onDelete('cascade')
                ->onupdate('cascade');

            $table->unique(array('company_id', 'cement_name'));

        });

        // DB::unprepared('ALTER TABLE `product` DROP PRIMARY KEY, ADD PRIMARY KEY ( `id`, `company_id`, `cement_name` )');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
 Schema::drop('product');

    }
}
