<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAltMedToReservationData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservation_data', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('alt_medicine_id')->nullable();
            $table->foreign('alt_medicine_id')->references('id')
                ->on('medicines')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservation_data', function (Blueprint $table) {
            //
        });
    }
}
