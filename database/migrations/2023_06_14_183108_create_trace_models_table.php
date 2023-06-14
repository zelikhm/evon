<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('trace_models', function (Blueprint $table) {
      $table->id();
      $table->integer('user_id');
      $table->string('order_id')->nullable();
      $table->string('title');
      $table->double('price', 10, 2);
      $table->string('status');
      $table->integer('type');
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
    Schema::dropIfExists('trace_models');
  }
};
