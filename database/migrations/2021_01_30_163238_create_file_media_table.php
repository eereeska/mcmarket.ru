<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileMediaTable extends Migration
{
    public function up()
    {
        Schema::create('file_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_id')->nullable()->constrained('files')->cascadeOnDelete();
            $table->string('src');
            $table->string('hash');
        });
    }

    public function down()
    {
        Schema::dropIfExists('file_media');
    }
}