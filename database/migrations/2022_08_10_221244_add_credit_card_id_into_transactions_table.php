<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreditCardIdIntoTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions',function (Blueprint $table){
            $table->unsignedInteger('credit_card_id')->nullable();
            $table->foreign('credit_card_id')->references('id')->on('credit_cards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions',function (Blueprint $table){
            $table->dropForeign('credit_card_id');
            $table->dropColumn('credit_card_id');
        });
    }
}
