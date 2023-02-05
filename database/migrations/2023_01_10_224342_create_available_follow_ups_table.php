<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailableFollowUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('available_follow_ups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id');
            $table->unsignedBigInteger('reservation_id');
            $table->foreign('child_id')->references('id')
                ->on('children')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('reservation_id')->references('id')
                ->on('reservations')->onUpdate('cascade')->onDelete('cascade');

            $table->date('available_to')->nullable();
            $table->unsignedInteger('available_for')->nullable();


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
        Schema::dropIfExists('available_follow_ups');
    }
}
