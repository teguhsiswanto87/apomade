<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_details', function (Blueprint $table) {
            $table->integer('shoppings_id')->unsigned()->index()->nullable();
            $table->foreign('shoppings_id')->references('id')->on('shoppings');

            $table->integer('products_id')->unsigned()->index()->nullable();
            $table->foreign('products_id')->references('id')->on('products');

            $table->bigInteger('price');
            $table->integer('qty');

            // multiple primary key
            $table->primary(array('shoppings_id', 'products_id'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopping_details');
    }
}
