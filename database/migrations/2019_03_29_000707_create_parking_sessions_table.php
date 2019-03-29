<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParkingSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parking_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id');
            $table->integer('parking_spot_id');
            $table->integer('customer_id');
            $table->integer('vehicle_id');
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
            $table->date('parking_date');
            $table->integer('paid')->default(0);
            $table->double('amount')->nullable();
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
        Schema::dropIfExists('parking_sessions');
    }
}
