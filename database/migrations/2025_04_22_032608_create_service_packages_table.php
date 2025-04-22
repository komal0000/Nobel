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
        Schema::create('service_packages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('age')->nullable();
            $table->integer('labtest')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->text('image')->nullable();
            $table->string('price')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('service_id')->constrained('services');
            $table->tinyInteger('gender')->nullable()->comment('0=>male, 1=>female, 2=>both');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_packages');
    }
};
