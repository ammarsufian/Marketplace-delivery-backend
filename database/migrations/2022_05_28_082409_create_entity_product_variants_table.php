<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_product_variants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('entity_product_id');
            $table->unsignedInteger('variant_id');
            $table->foreign('entity_product_id')->references('id')->on('entity_products');
            $table->foreign('variant_id')->references('id')->on('variants');
            $table->decimal('price',10,3);
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
        Schema::dropIfExists('entity_product_variants');
    }
}
