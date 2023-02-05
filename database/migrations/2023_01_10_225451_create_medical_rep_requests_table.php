<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRepRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_rep_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medical_rep_id');
            $table->unsignedBigInteger('slot_id')->nullable();

            $table->foreign('medical_rep_id')->references('id')
                ->on('sale_people')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('slot_id')->references('id')
                ->on('slots')->onUpdate('cascade')->onDelete('cascade');

            $table->string('comment',800)->nullable();
            $table->string('secretary_comment',800)->nullable();
            $table->string('status')->default('pending');
            $table->dateTime('special_datetime')->nullable();

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
        Schema::dropIfExists('medical_rep_requests');
    }
}
