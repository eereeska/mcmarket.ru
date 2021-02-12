<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileTables extends Migration
{
    public function up()
    {
        Schema::create('file_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('title');
            $table->string('icon')->default('layers');
        });

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
            $table->string('cover_path')->nullable();
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
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
            $table->timestamp('version_updated_at')->useCurrent();
            $table->timestamps();
        });

        Schema::create('file_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_id')->constrained()->cascadeOnDelete();
            $table->string('version')->nullable();
            $table->longText('description_raw')->nullable();
            $table->longText('description_html')->nullable();
            $table->timestamps();
        });

        Schema::create('file_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_id')->constrained('files')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('file_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_id')->nullable()->constrained('files')->cascadeOnDelete();
            $table->string('name');
            $table->enum('type', ['image', 'video']);
            $table->string('url')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('file_categories');
        Schema::dropIfExists('files');
        Schema::dropIfExists('file_versions');
        Schema::dropIfExists('file_purchases');
        Schema::dropIfExists('file_media');
    }
}