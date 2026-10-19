<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            $table->string('id_user', 15)->nullable();

            $table->string('action');
            
            $table->string('target_user_id', 15)->nullable();

            $table->string('old_role')->nullable();
            $table->string('new_role')->nullable();

            $table->timestamps();

            $table->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->nullOnDelete();

            $table->foreign('target_user_id')
                ->references('id_user')
                ->on('users')
                ->nullOnDelete();

            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};