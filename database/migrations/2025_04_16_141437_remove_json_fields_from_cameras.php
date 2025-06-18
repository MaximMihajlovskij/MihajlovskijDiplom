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
        Schema::table('cameras', function (Blueprint $table) {
            $table->dropColumn(['specifications', 'accessories', 'documents']); // ❌ Удаляем JSON-поля
        });
    }

    public function down(): void
    {
        Schema::table('cameras', function (Blueprint $table) {
            $table->json('specifications')->nullable(); // 🔄 Восстанавливаем если миграцию откатывают
            $table->json('accessories')->nullable();
            $table->json('documents')->nullable();
        });
    }
};
