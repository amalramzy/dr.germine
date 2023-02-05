<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToRepReservationss extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('represervations', function (Blueprint $table) {
            //
            $table->string('arrive_time')->nullable()->after('secretarial_comment');
            $table->string('enter_time')->nullable()->after('arrive_time');
            $table->string('finish_time')->nullable()->after('enter_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('represervations', function (Blueprint $table) {
            //
        });
    }
}
