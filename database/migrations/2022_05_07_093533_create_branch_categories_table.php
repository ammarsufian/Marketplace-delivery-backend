<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_categories', function (Blueprint $table) {
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('branch_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->unique(['branch_id', 'category_id']);
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
        Schema::dropIfExists('branch_categories');
    }
}
