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
        Schema::create('accessories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('turniket_id')->nullable(); 
            $table->unsignedBigInteger('camera_id')->nullable();
            $table->unsignedBigInteger('barrier_id')->nullable();
            $table->string('name'); 
            $table->string('image')->nullable(); 
            $table->text('description')->nullable(); 
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
        Schema::dropIfExists('accessories');
    }
};
