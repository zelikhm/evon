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
          $table->decimal('ping');
          $table->dropColumn('name');
          $table->string('first_name');
          $table->string('last_name');
          $table->string('status')->comment('Должность');
          $table->string('link')->comment('Ссылка на соц.сеть');
          $table->longText('description');
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
