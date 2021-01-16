<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->string('title');
            $table->text('body');
            $table->unsignedInteger('replies_count')->default(0);
            $table->unsignedInteger('views')->default(0);
            $table->timestamp('last_reply_at')->default(now());
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('threads');
    }
}