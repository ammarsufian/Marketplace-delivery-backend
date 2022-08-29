<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewJoinersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_joiners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('mobile_number');
            $table->enum('type', ['partner', 'rider']);
            $table->enum('status', ['pending','rejected','approved' ])->default('pending');
            $table->string('comment')->nullable();
            $table->unsignedInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
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
        Schema::dropIfExists('new_joiners');
    }
}
