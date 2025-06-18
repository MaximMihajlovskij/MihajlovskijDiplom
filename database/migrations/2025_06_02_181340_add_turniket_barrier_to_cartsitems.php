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
        Schema::table('cartsitems', function (Blueprint $table) {
            $table->unsignedBigInteger('turniket_id')->nullable()->after('camera_id'); // ✅ Добавляем `turniket_id`
            $table->unsignedBigInteger('barrier_id')->nullable()->after('turniket_id'); // ✅ Добавляем `barrier_id`
    
            $table->foreign('turniket_id')->references('id')->on('turnikets')->onDelete('cascade');
            $table->foreign('barrier_id')->references('id')->on('barriers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cartsitems', function (Blueprint $table) {
            $table->dropForeign(['turniket_id']); // 🔹 Удаляем связь
            $table->dropForeign(['barrier_id']); // 🔹 Удаляем связь
            $table->dropColumn(['turniket_id', 'barrier_id']);
        });
    }
};
