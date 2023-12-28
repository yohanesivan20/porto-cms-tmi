<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartMasterProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_master_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('branch_id')->index();
            $table->unsignedBigInteger('status_master_product_id')->index();
            $table->unsignedBigInteger('master_product_id')->index();
            $table->decimal('price', 12, 0);
            $table->integer('min_order');
            $table->integer('min_qty');
            $table->integer('max_qty');
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('status_master_product_id')->references('id')->on('status_master_products');
            $table->foreign('master_product_id')->references('id')->on('master_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_master_products');
    }
}
