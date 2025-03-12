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
        Schema::create('technology_section_data', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('image');
            $table->text('short_description');
            $table->text('long_description');
            $table->foreignId('technology_id')->constrained('technologies');
            $table->foreignId('technology_section_id')->constrained('technology_sections');
            $table->foreignId('technology_section_type_id')->constrained('technology_section_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technology_section_data');
    }
};
