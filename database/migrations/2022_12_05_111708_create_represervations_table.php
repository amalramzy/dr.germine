<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepreservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('represervations', function (Blueprint $table) {
            $table->id();
            $table->string('slot_id')->nullable();
            $table->string('slot_order')->default(0);
            $table->dateTime('special_datetime')->nullable();
            $table->text('comment')->nullable();
            $table->string('status')->default("pending");
            $table->unsignedBigInteger('salePerson_id');
            $table->foreign('salePerson_id')->references('id')->on('sale_people')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('represervations');
    }
}
