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
        Schema::create('user_meeting_participants', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['MODERATOR', 'VIEWER']);
            $table->string('name');
            $table->string('email')->nullable();
            $table->boolean('is_guest')->default(false);
            $table->string('join_url');
            $table->unsignedBigInteger('meeting_id');
            $table->foreign('meeting_id')->references('id')->on('user_meetings')->cascadeOnDelete();
            $table->text('bridge_url')->nullable();
            $table->text('bridge_password')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('user_meeting_participants');
    }
};
