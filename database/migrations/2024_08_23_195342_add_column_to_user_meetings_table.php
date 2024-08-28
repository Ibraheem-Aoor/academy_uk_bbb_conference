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
            $table->integer('successfull_joins')->after('deleted_at')->default(0);
            $table->integer('failed_joins')->after('deleted_at')->default(0);
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
            $table->dropColumn(['successfull_joins', 'failed_joins']);
        });
    }
};
