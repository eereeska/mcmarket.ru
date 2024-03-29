<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTables extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->float('balance', 8, 2, true)->default(0);
            $table->string('ip')->nullable();
            $table->string('avatar')->nullable();
            $table->string('password')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_moderator')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->rememberToken();
            $table->timestamp('last_seen_at')->nullable();
            $table->timestamps();
        });

        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->text('about')->nullable();
            $table->boolean('is_search_engine_visible')->default(true);
            $table->boolean('is_online_status_visible')->default(true);
            $table->enum('groups_visible', ['all', 'mine', 'none'])->default('mine');  
        });

        Schema::create('user_followers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('follower_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_settings');
        Schema::dropIfExists('user_followers');
    }
}