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
        Schema::table('barriers', function (Blueprint $table) {
            $table->unsignedInteger('quantity')->default(0)->after('firm_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barriers', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
};
