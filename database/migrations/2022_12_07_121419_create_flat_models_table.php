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
        Schema::create('flat_models', function (Blueprint $table) {
            $table->id();
            $table->integer('frame_id');
            $table->integer('number')->comment('Номер');
            $table->integer('square')->comment('Площадь');
            $table->integer('count')->comment('Планировка');
            $table->integer('floor')->comment('Этаж');
            $table->string('status')->comment('Статус');
            $table->integer('number_from_stairs')->comment('Номер от лестницы');
            $table->double('price', 8, 0)->comment('Цена');
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
        Schema::dropIfExists('flat_models');
    }
};
