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
        Schema::create('all_recordings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('meeting_id');
            $table->string('record_id')->unique();
            $table->string('playback_url');
            $table->string('end_time');
            $table->integer('duration');
            $table->json('meta_data')->nullable();
            $table->boolean('is_backed_up')->default(false);
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
        Schema::dropIfExists('all_recordings');
    }
};
