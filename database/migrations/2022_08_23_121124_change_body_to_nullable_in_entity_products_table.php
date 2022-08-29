<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeBodyToNullableInEntityProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entity_products', function (Blueprint $table) {
            $table->integer('vat')->default(0)->change();
            $table->integer('discount')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entity_products', function (Blueprint $table) {
            $table->integer('vat');
            $table->integer('discount');
        });
    }
}
