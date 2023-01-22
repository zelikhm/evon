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
        Schema::create('house_characteristics_models', function (Blueprint $table) {
            $table->id();
            $table->integer('house_id')->comment('Айди жк');
            $table->integer('floors')->comment('Этажи');
            $table->string('type')->comment('Тип здания');
            $table->string('dop')->comment('Дополнительные услуги');
            $table->string('info')->comment('Инфраструктура');
            $table->integer('toSea')->comment('До моря');
            $table->integer('toSchool')->comment('До школы');
            $table->integer('toShop')->comment('До тц');
            $table->integer('toPark')->comment('До парка');
            $table->integer('toChildrenSchool')->comment('До садика');
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
        Schema::dropIfExists('house_characteristics_models');
    }
};
