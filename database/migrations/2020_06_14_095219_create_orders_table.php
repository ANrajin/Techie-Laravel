<?php

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
            $table->id();
            $table->string('order_id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')
            ->references('id')->on('users')
            ->onDelete('cascade');
            $table->text('shipping_details');
            $table->text('cart_details');
            $table->string('payment_method');
            $table->string('charge_id')->nullable();
            $table->string('status')->default('due');
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
