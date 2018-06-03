<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsletterSubscriberTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter__subscriber_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('subscriber_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['subscriber_id', 'locale']);
            $table->foreign('subscriber_id')->references('id')->on('newsletter__subscribers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('newsletter__subscriber_translations', function (Blueprint $table) {
            $table->dropForeign(['subscriber_id']);
        });
        Schema::dropIfExists('newsletter__subscriber_translations');
    }
}
