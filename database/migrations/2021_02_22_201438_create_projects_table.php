<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->string('estimate_time')->nullable();
            $table->unsignedBigInteger('project_manager_id')->nullable();
            $table->integer('number_of_developers')->nullable();
            $table->string('pm_description')->nullable();
            $table->string('project_progress')->default('0');
            $table->string('project_progress_comment')->nullable();
            $table->tinyInteger('project_status')->default('10');
            $table->timestamps();
            $table->foreign('project_manager_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('projects');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
