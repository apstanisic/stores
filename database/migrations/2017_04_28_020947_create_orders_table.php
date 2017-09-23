<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('price')->nullable();
            $table->string('slug');
            $table->integer('buyer_id')->unsigned()->index()->nullable();
            $table->integer('address_id')->unsigned()->index()->nullable();
            $table->integer('store_id')->unsigned()->index()->nullable();
            $table->integer('status_id')->unsigned()->index()->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('buyer_id')
                  ->references('id')
                  ->on('buyers')
                  ->onDelete('set null');

            $table->foreign('address_id')
                  ->references('id')
                  ->on('addresses')
                  ->onDelete('set null');

            $table->foreign('status_id')
                  ->references('id')
                  ->on('status');

            $table->foreign('store_id')
                  ->references('id')
                  ->on('stores')
                  ->onDelete('set null');
        });


        Schema::create('order_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount');
            $table->integer('product_price');
            $table->integer('order_id')->unsigned()->index()->nullable();
            $table->integer('product_id')->unsigned()->index()->nullable();
            $table->timestamps();

            $table->foreign('order_id')
                  ->references('id')
                  ->on('orders')
                  ->onDelete('set null');

            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('orders');
    }
}
