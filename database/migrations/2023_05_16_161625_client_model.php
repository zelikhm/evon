<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_models', function (Blueprint $table) {
          $table->integer('user_id');
          $table->string('name');
          $table->string('phone');
          $table->string('soc');
          $table->string('client_text');
          $table->string('jk');
          $table->integer('status_client');
          $table->integer('status_order');
          $table->string('comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
