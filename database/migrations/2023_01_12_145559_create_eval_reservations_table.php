<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvalReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eval_reservations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('evaluation_id')
            ->constrained('evaluations')
            ->onDelete('cascade');

            $table->foreignId('reservation_id')
            ->constrained('reservations')
            ->onDelete('cascade');

            $table->integer('score')->default(0);

            $table->unique(['evaluation_id', 'reservation_id']);

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
        Schema::dropIfExists('eval_reservations');
    }
}
