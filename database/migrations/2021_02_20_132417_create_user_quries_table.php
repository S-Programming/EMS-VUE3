<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUserQuriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_quries', function (Blueprint $table) {
            $table->id();
//            $table->string('first_name')->nullable();
//            $table->string('last_name')->nullable();
//            $table->string('email');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('query_status_id');
            $table->string('topic')->nullable();
            $table->string('description')->nullable();
            $table->string('admin_comment')->nullable();
            $table->string('status')->default("Good");
            $table->string('is_view')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('query_status_id')->references('id')->on('query_statuses')->onDelete('cascade');
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
        Schema::dropIfExists('user_quries');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
