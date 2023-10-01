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
    Schema::table('house_images_models', function (Blueprint $table) {
      $table->boolean('isResize')->default(false);
    });
    Schema::table('flat_images_models', function (Blueprint $table) {
      $table->boolean('isResize')->default(false);
    });
    Schema::table('house_main_image_models', function (Blueprint $table) {
      $table->boolean('isResize')->default(false);
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
