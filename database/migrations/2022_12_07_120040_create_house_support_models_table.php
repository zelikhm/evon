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
        Schema::create('house_support_models', function (Blueprint $table) {
            $table->id();
            $table->integer('house_id');
            $table->string('avatar')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('status')->comment('Должность');
            $table->string('link')->comment('Ссылка на соц.сеть');
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
        Schema::dropIfExists('house_support_models');
    }
};
