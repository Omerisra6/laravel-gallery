<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('original_video');
            $table->string('reduced_video');
            $table->string('image_display');
            $table->string('duration');
            $table->string('made_for');
            $table->string('description')->nullable();
            $table->string('resolution');
            $table->string('project_number', 128);
            $table->string('key_words');
            $table->string('ratio');
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
        Schema::dropIfExists('videos');
    }
}



