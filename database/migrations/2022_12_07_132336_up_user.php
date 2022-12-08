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
        schema::table('users', function (Blueprint $table) {
          $table->string('email')->nullable()->change();
          $table->decimal('ping')->nullable()->change();
          $table->string('first_name')->nullable()->change();
          $table->string('last_name')->nullable()->change();
          $table->string('status')->comment('Должность')->nullable()->change();
          $table->string('link')->comment('Ссылка на соц.сеть')->nullable()->change();
          $table->longText('description')->nullable()->change();
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
