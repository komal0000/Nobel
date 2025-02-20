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
        Schema::create('treatment_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('blog');
            $table->text('description')->nullable();
            $table->string('style_type');
            $table->foreignId('treatment_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment_sections');
    }
};
