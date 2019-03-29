<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_revenues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id');
            $table->integer('customer_id');
            $table->integer('parking_id');
            $table->timestamp('paid_at');
            $table->double('amount');
            $table->integer('status')->default(1);
            $table->date('payment_date');
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
        Schema::dropIfExists('city_revenues');
    }
}
