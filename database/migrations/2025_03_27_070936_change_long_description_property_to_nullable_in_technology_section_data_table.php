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
        Schema::table('technology_section_data', function (Blueprint $table) {
            $table->text('short_description')->nullable()->change();
            $table->text('long_description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('technology_section_data', function (Blueprint $table) {
            $table->text('short_description')->change();
            $table->text('long_description')->change();
        });
    }
};
