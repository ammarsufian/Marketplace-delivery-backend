<?php

use App\Domains\OrderManagement\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('total', 10, 3);
            $table->decimal('subtotal', 10, 3);
            $table->decimal('discount', 10, 3);
            $table->decimal('vat', 10, 3);
            $table->decimal('delivery',10,3);
            $table->string('status');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('promo_code_id')->nullable();
            $table->foreign('promo_code_id')->references('id')->on('promo_codes');
            $table->unsignedInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->unsignedInteger('address_id');
            $table->foreign('address_id')->references('id')->on('addresses');
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
        Schema::dropIfExists('orders');
    }
}
