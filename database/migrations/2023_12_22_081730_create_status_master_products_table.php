<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusMasterProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_master_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status', 50);
            $table->tinyInteger('can_order');
            $table->tinyInteger('can_sell');
            $table->tinyInteger('can_archive');
            $table->tinyInteger('flag_active');
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
        Schema::dropIfExists('status_master_products');
    }
}
