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
            $table->string('image_url')->nullable()->after('camera_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cartsitems', function (Blueprint $table) {
            $table->dropColumn('image_url');
        });
    }
};
