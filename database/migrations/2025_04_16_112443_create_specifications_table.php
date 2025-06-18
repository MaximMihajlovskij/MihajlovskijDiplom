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
        Schema::create('specifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('turniket_id'); 
            $table->unsignedBigInteger('camera_id'); 
            $table->unsignedBigInteger('barrier_id'); 
            $table->string('key'); 
            $table->string('value'); 
            $table->timestamps();

            $table->foreign('turniket_id')->references('id')->on('turnikets')->onDelete('cascade');
            $table->foreign('camera_id')->references('id')->on('cameras')->onDelete('cascade');
            $table->foreign('barrier_id')->references('id')->on('barriers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specifications');
    }
};
