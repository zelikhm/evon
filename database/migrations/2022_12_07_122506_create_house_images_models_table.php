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
        Schema::create('house_images_models', function (Blueprint $table) {
            $table->id();
            $table->integer('house_id')->comment('Айди жк');
            $table->integer('category')->comment('Айди категории');
            $table->string('name')->comment('Название изображения');
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
        Schema::dropIfExists('house_images_models');
    }
};
