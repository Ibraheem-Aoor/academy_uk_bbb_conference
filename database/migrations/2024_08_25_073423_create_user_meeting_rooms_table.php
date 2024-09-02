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
            $table->date('start_date');
            $table->date('end_date');
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
