<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{

    /**

     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('slot_id')->nullable();
            $table->string('slot_order')->default(0);
            $table->dateTime('special_datetime')->nullable();
            $table->text('patient_comment')->nullable();
            $table->text('secretarial_comment')->nullable();
            $table->string('status')->default("pending");
            $table->string('arrive_time')->nullable();
            $table->string('enter_time')->nullable();
            $table->string('finish_time')->nullable();
            $table->unsignedBigInteger('child_id');
            $table->foreign('child_id')->references('id')->on('children')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('reservations');
    }
}
