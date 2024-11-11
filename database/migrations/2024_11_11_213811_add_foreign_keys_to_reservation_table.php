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
        Schema::table('reservation', function (Blueprint $table) {
            $table->foreign(['user_id'], 'reservation_ibfk_1')->references(['user_id'])->on('user')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['room_id'], 'reservation_ibfk_2')->references(['room_id'])->on('room')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservation', function (Blueprint $table) {
            $table->dropForeign('reservation_ibfk_1');
            $table->dropForeign('reservation_ibfk_2');
        });
    }
};
