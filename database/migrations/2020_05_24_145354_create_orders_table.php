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
            $table->integer('pickup_contact_id');
            $table->string('pickup_note')->nullable();

            $table->string('delivery_contact_id');
            $table->string('delivery_note');

            $table->integer('product_id');
            $table->string('order_note');

            $table->string('status');
            $table->integer('user_id');

            $table->integer('merchant_id');
            $table->integer('company_id');
            $table->integer('package_id');

            $table->timestamps();
            $table->softdeletes();
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
