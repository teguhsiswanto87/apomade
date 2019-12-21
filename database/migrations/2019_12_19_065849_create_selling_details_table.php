<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_details', function (Blueprint $table) {
            $table->integer('sellings_id')->unsigned()->index()->nullable();
            $table->foreign('sellings_id')->references('id')->on('sellings');

            $table->integer('products_id')->unsigned()->index()->nullable();
            $table->foreign('products_id')->references('id')->on('products');

//            $table->bigInteger('capital');
//            $table->bigInteger('selling_price');
            $table->integer('qty');

            // multiple primary key
            $table->primary(array('sellings_id', 'products_id'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selling_details');
    }
}
