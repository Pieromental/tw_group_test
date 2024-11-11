<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservation', function (Blueprint $table) {
            $table->string('reservation_id', 36)->primary();
            $table->string('user_id', 36)->index('user_id');
            $table->string('room_id', 36)->index('room_id');
            $table->dateTime('reservation_date');
            $table->char('status', 2)->nullable();
            $table->string('created_by', 36)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->string('updated_by', 36)->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};
