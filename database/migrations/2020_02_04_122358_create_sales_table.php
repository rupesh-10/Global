<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->index('user_id')->nullable();
            $table->string('address');
            $table->bigInteger('phone_number');
            $table->unsignedInteger('guest_id')->nullable();
            $table->boolean('is_guest');
            $table->boolean('is_finalized')->nullable();
            $table->boolean('is_started')->nullabel();
            $table->boolean('is_delivered')->nullable();
            $table->string('client_name');
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
        Schema::dropIfExists('sales');
    }
}
