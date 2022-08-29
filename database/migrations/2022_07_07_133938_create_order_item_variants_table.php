<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item_variants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_item_id');
            $table->foreign('order_item_id')->references('id')->on('order_items');
            $table->unsignedInteger('variant_id');
            $table->foreign('variant_id')->references('id')->on('variants');
            $table->integer('price')->unsigned();
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
        Schema::dropIfExists('order_item_variants');
    }
}
