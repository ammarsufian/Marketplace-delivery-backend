<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_item_variants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cart_item_id');
            $table->foreign('cart_item_id')->references('id')->on('cart_items');
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
        Schema::dropIfExists('cart_item_variants');
    }
}
