<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSenderInvitationIdIntoUserTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_transactions',function (Blueprint $table){
            $table->unsignedInteger('invitation_sender_id')->nullable();
            $table->foreign('invitation_sender_id')->references('id')
                ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_transactions',function (Blueprint $table){
            $table->dropForeign('invitation_sender_id');
            $table->dropColumn('invitation_sender_id');
        });
    }
}
