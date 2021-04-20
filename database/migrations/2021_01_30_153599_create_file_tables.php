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
            $table->string('icon');
        });

        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('file_categories')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            // $table->foreignId('version_id')->constrained('file_versions');
            $table->string('title');
            $table->string('name');
            $table->decimal('price', 8, 2, true)->nullable();
            $table->enum('state', ['visible', 'moderated', 'deleted']);
            $table->unsignedInteger('views_count')->default(0);
            $table->unsignedInteger('downloads_count')->default(0);
            $table->timestamp('icon_updated_at')->nullable();
            $table->timestamps();
        });

        // Schema::create('file_versions', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('file_id')->constrained('files')->cascadeOnDelete();
        //     $table->string('title')->nullable();
        //     $table->mediumText('description')->nullable();
        //     $table->unsignedBigInteger('size');
        //     $table->enum('state', ['visible', 'moderated', 'deleted']);
        //     $table->string('vt_id')->nullable();
        //     $table->enum('vt_status', ['completed', 'queued', 'in-progress'])->nullable();
        //     $table->json('vt_stats')->nullable();
        //     $table->string('vt_hash')->nullable();
        //     $table->timestamps();
        // });

        Schema::create('file_meta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_id')->constrained('files')->cascadeOnDelete();
            $table->mediumText('description')->nullable();
            $table->string('keywords')->nullable();
            $table->string('version')->nullable();
            $table->string('extension')->nullable();
            $table->string('donation_url')->nullable();
            $table->string('vt_id')->nullable();
            $table->enum('vt_status', ['completed', 'queued', 'in-progress'])->nullable();
            $table->json('vt_stats')->nullable();
            $table->string('vt_hash')->nullable();
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
        Schema::dropIfExists('file_purchases');
        Schema::dropIfExists('file_media');
    }
}