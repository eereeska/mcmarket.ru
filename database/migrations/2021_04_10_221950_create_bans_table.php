<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBansTable extends Migration
{
    public function up()
    {
        Schema::create('bans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('by_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('reason')->nullable();
            $table->timestamp('expire_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bans');
    }
}
