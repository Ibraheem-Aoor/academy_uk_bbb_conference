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
        Schema::table('user_meetings', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id')->after('user_id');
            $table->foreign('room_id')->references('id')->on('user_meeting_rooms')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_meetings', function (Blueprint $table) {
            $table->dropForeign('room_id');
            $table->dropColumn('room_id');
        });
    }
};
