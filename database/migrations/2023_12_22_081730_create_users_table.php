<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('branch_id')->index();
            $table->smallInteger('role')->index();
            $table->string('name', 150);
            $table->string('email', 150)->unique();
            $table->string('phone_number', 150)->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('flag_active')->index();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
