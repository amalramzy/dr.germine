<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClincsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('clincs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('location_url');

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
        Schema::dropIfExists('clincs');
    }
}
