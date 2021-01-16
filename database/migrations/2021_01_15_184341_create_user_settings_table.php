<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('about')->nullable();
            $table->boolean('is_search_engine_visible')->default(true);
            $table->boolean('is_online_status_visible')->default(true);
            $table->boolean('is_activity_visible')->default(true);  
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_settings');
    }
}