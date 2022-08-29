<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_events', function (Blueprint $table) {
            $table->id();
            $table->char('batch_id', 36)->nullable();
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->string('name')->nullable();
            $table->string('actionable_type')->nullable();
            $table->unsignedBigInteger('actionable_id')->nullable();
            $table->string('target_type')->nullable();
            $table->unsignedBigInteger('target_id')->nullable();
            $table->string('model_type')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->text('fields')->nullable();
            $table->string('status', 25)->default('running');
            $table->text('exception')->nullable();
            $table->timestamps();

            $table->index(['actionable_type', 'actionable_id'])->nullable();
            $table->index(['batch_id', 'model_type', 'model_id'])->nullabel();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_events');
    }
}
