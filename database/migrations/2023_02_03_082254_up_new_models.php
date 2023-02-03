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
        Schema::table('house_models', function (Blueprint $table) {
          $table->float('percent', 3, 2)->nullable()->change();
        });

      Schema::table('house_characteristics_models', function (Blueprint $table) {
        $table->integer('count_flat')->change();
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
