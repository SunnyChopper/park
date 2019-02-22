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
            $table->integer('admin_id');
            $table->string('first_name', 128);
            $table->string('last_name', 128);
            $table->string('email', 256);
            $table->string('username', 128);
            $table->string('password', 128);
            $table->integer('permission');
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
