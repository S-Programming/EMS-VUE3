<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTechnologyStackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_technology_stack', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('technology_stack_id');
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('technology_stack_id')->references('id')->on('technology_stacks')->onDelete('cascade');
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
        Schema::dropIfExists('project_technology_stack');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
