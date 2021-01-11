<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('is_parent_menu')->default('1');
            $table->unsignedInteger('parent_menu_id');
            $table->string('link');
            $table->text('module');
            $table->string('sort_order');
            $table->string('class');
            $table->string('icon');
            $table->tinyInteger('is_count')->default('0');
            $table->tinyInteger('is_active')->default('0');
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
        Schema::dropIfExists('menus');
    }
}

