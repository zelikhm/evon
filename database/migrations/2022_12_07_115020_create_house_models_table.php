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
        Schema::create('house_models', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('Айди юзера');
            $table->string('title')->comment('Название');
            $table->longText('description')->comment('Описание');
            $table->string('city')->comment('Город');
            $table->string('area')->comment('Район');
            $table->string('longitude')->comment('Долгота');
            $table->string('latitude')->comment('Широта');
            $table->integer('percent')->comment('Коммисиия');
            $table->string('comment')->comment('Комментарий')->nullable();
            $table->integer('active')->comment('0-на модерации, 1-не прошел, 2-прошел(опубликовано)')->default(0);
            $table->string('status')->comment('Статус, доступен после одобрения');
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
        Schema::dropIfExists('house_models');
    }
};
