<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_data', function (Blueprint $table) {
            $table->id();
            $table->morphs('reservable');
            $table->unsignedBigInteger('reservation_id');
            $table->unsignedBigInteger('dose_id')->nullable();
            $table->string('period')->nullable();
            $table->text('notes')->nullable();
            $table->foreign('reservation_id')->references('id')
                ->on('reservations')->onDelete('cascade');
            $table->foreign('dose_id')->references('id')
                ->on('doses')->onDelete('SET NULL');

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
        Schema::dropIfExists('reservation_data');
    }
}
