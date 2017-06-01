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
            $table->unsignedInteger('service_id')->nullable();
            $table->unsignedInteger('state_id')->default(1);
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->timestamps();

            $table->foreign('service_id')->references('id')->
                            on('services');
            $table->foreign('state_id')->references('id')->
                            on('order_states');

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

