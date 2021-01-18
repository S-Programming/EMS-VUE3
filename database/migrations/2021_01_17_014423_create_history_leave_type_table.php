<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryLeaveTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_leave_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leave_history_id');
            $table->unsignedBigInteger('leave_type_id');
            $table->timestamps();
            $table->foreign('leave_history_id')->references('id')->on('leave_history')->onDelete('cascade');
            $table->foreign('leave_type_id')->references('id')->on('leave_type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_leave_type');
    }
}
