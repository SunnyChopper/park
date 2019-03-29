<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('city', 128);
            $table->string('state', 128);
            $table->string('zipcode', 64)->nullable();
            $table->string('email', 128);
            $table->string('username', 128);
            $table->string('password', 128);
            $table->integer('application_status')->default(0);
            $table->integer('is_active')->default(1);
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
        Schema::dropIfExists('city_accounts');
    }
}
