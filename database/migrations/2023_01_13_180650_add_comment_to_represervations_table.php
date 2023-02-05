<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentToRepreservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('represervations', function ($table) {
            $table->text('doctor_comment')->nullable()->after('comment');
            $table->text('secretarial_comment')->nullable()->after('doctor_comment');

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
            $table->dropColumn(['type','doctor_comment','secretarial_comment','arrive_time','finish_time','enter_time']);
        });
    }
}
