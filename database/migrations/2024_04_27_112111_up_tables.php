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
        Schema::rename('favorites_models', 'favorites');
        Schema::rename('flat_images_models', 'flat_images');
        Schema::rename('flat_models', 'flat');
        Schema::rename('frame_models', 'frames');
        Schema::rename('house_characteristics_models', 'house_characteristics');
        Schema::rename('house_files_models', 'house_files');
        Schema::rename('house_images_models', 'house_images');
        Schema::rename('house_main_image_models', 'house_main_images');
        Schema::rename('house_models', 'houses');
        Schema::rename('house_news_models', 'house_news');
        Schema::rename('house_support_models', 'house_supports');
        Schema::rename('house_views_models', 'house_views');
        Schema::rename('image_log_models', 'image_logs');
        Schema::rename('message_models', 'messages');
//        Schema::rename('notification_models', 'notifications');
//        Schema::rename('notification_models', 'notifications');
      Schema::rename('payment_log_models', 'payment_logs');
      Schema::rename('payment_models', 'payments');
      Schema::rename('region_models', 'regions');
      Schema::rename('session_models', 'sessions');
      Schema::rename('structure_models', 'structures');
      Schema::rename('subscription_models', 'subscriptions');
      Schema::rename('tarif_models', 'tarifs');
      Schema::rename('tarif_russion_models', 'tarif_russions');
      Schema::rename('trace_models', 'traces');
      Schema::rename('types_models', 'types');
      Schema::rename('verification_models', 'verification');
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
