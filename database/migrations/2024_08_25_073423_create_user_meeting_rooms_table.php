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
        Schema::create('user_meeting_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('max_meetings')->comment('per room');
            $table->integer('max_participants')->comment('per room');
            $table->integer('max_storage_allowed')->comment('per room');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('user_meeting_rooms');
    }
};
