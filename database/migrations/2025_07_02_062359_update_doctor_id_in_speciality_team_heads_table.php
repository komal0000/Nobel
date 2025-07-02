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
        Schema::table('speciality_team_heads', function (Blueprint $table) {
         $table->dropUnique(['doctor_id']);
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('speciality_team_heads', function (Blueprint $table) {
         $table->unique('doctor_id');
        });
    }
};
