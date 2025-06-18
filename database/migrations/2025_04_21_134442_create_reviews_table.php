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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->text('content'); 
            $table->unsignedBigInteger('rating')->default(5); 
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('camera_id')->nullable(); 
            $table->unsignedBigInteger('turniket_id')->nullable(); 
            $table->unsignedBigInteger('barrier_id')->nullable(); 
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('camera_id')->references('id')->on('cameras')->onDelete('cascade');
            $table->foreign('turniket_id')->references('id')->on('turnikets')->onDelete('cascade');
            $table->foreign('barrier_id')->references('id')->on('barriers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
