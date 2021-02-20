<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
//            $table->string('first_name')->nullable();
//            $table->string('last_name')->nullable();
//            $table->string('email');
            $table->unsignedBigInteger('user_id');
            $table->string('topic');
            $table->string('description')->nullable();
            $table->string('admin_comment')->nullable();
            $table->string('status')->default("Good");
            $table->string('is_view')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists('feedback');
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }
}
