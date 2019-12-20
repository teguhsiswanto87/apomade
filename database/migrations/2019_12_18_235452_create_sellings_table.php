<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('market_places_id')->unsigned()->index()->nullable(true);
            $table->foreign('market_places_id')->references('id')->on('market_places');

            $table->integer('couriers_id')->unsigned()->index()->nullable(true);
            $table->foreign('couriers_id')->references('id')->on('couriers');

            $table->date('purchase_date');
            $table->string('buyers_name');
            $table->integer('shipping_tax')->nullable(true);
            $table->integer('voucher_discount')->nullable(true);
            $table->integer('turnover');
            $table->integer('profit');
            $table->string('selling_status');
            $table->string('note');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellings');
    }
}
