<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadTagsTable extends Migration
{
    public function up()
    {
        Schema::create('thread_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('thread_id');
            $table->unsignedBigInteger('tag_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('thread_tags');
    }
}