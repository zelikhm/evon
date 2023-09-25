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
        Schema::create('verification_models', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('link')->nullable();
            $table->string('file')->nullable();
            $table->integer('isVerification')
              ->comment('0 - Не верефицирован, 1 - Модерация, 2 - Верифицирован')
              ->default(false);
            $table->string('text')->nullable();
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
        Schema::dropIfExists('verification_models');
    }
};
