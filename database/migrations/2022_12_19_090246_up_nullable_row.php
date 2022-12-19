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
    schema::table('house_models', function (Blueprint $table) {
      $table->longText('description')->nullable()->change();
      $table->string('image')->nullable()->change();
    });

    schema::table('house_characteristics_models', function (Blueprint $table) {
      $table->integer('toSea')->nullable()->change();
      $table->integer('toSchool')->nullable()->change();
      $table->integer('toShop')->nullable()->change();
      $table->integer('toPark')->nullable()->change();
      $table->integer('toChildrenSchool')->nullable()->change();
      $table->integer('toBus')->nullable()->change();
    });

    schema::table('house_support_models', function (Blueprint $table) {
      $table->string('avatar')->nullable()->change();
      $table->string('status')->nullable()->change();
      $table->string('link')->nullable()->change();
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
