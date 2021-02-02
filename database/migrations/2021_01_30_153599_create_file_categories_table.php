<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('file_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('icon')->default('layers');
        });
    }

    public function down()
    {
        Schema::dropIfExists('file_categories');
    }
}