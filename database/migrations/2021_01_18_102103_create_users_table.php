<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('role_id')->nullable()->default(1)->constrained('roles')->nullOnDelete();
            $table->foreignId('settings_id')->nullable()->constrained('user_settings')->nullOnDelete();
            $table->boolean('verified')->default(false);
            $table->float('balance', 8, 2, true)->default(0);
            $table->string('ip');
            $table->string('avatar')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamp('last_seen_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}