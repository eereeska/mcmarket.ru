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
            $table->text('about')->nullable();
            $table->boolean('is_search_engine_visible')->default(true);
            $table->boolean('is_online_status_visible')->default(true);
            $table->enum('groups_visible', ['all', 'mine', 'none'])->default('mine');  
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_settings');
    }
}