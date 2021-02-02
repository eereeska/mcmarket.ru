<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('file_categories')->nullOnDelete();
            $table->string('title');
            $table->string('short_title');
            $table->string('slug');
            $table->enum('type', ['free', 'paid', 'nulled']);
            $table->float('price', 8, 2, true)->default(0);
            $table->integer('size');
            $table->string('path');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('keywords')->nullable();
            $table->string('version')->nullable();
            $table->string('extension')->nullable();
            $table->string('donation_url')->nullable();
            $table->string('external_path')->nullable();
            $table->string('vt_id')->nullable();
            $table->enum('vt_status', ['cmopleted', 'queued', 'in-progress'])->nullable();
            $table->json('vt_stats')->nullable();
            $table->string('vt_hash')->nullable();
            $table->unsignedBigInteger('views_count')->default(0);
            $table->unsignedBigInteger('downloads_count')->default(0);
            $table->boolean('is_visible')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
}