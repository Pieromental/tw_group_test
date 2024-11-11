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
        Schema::create('user', function (Blueprint $table) {
            $table->string('user_id', 36)->primary();
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('password');
            $table->string('role_id', 36)->index('role_id');
            $table->integer('active')->nullable()->default(1);
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
        Schema::dropIfExists('user');
    }
};
