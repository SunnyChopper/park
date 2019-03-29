<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubuserAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subuser_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id');
            $table->string('first_name', 128);
            $table->string('last_name', 128);
            $table->string('email', 128);
            $table->string('username', 128);
            $table->string('password', 128);
            $table->integer('permission')->default(0);
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
        Schema::dropIfExists('subuser_accounts');
    }
}
