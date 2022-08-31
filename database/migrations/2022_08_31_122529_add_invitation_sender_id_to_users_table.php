<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvitationSenderIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('invitation_sender_id')->nullable();
            $table->foreign('invitation_sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->dropColumn('referral_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('invitation_sender_id');
            $table->string('referral_key')->nullable();
        });
    }
}
