<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('video_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('ip_address');
            $table->string('user_agent');
            $table->integer('view_duration')->comment('View duration in seconds');
            $table->boolean('completed')->default(false);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            // Indexes for common queries
            $table->index(['video_id', 'created_at']);
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_views');
    }
}