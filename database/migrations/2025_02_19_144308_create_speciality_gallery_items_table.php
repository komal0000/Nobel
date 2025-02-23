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
        Schema::create('speciality_gallery_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->text('extra_data')->nullable();
            $table->foreignId('specialty_id')->nullable()->constrained('specialties');
            $table->foreignId('speciality_gallery_id')->constrained('speciality_galleries');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speciality_gallery_items');
    }
};
