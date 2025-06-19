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
        Schema::table('doctor_specialities', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
            $table->dropForeign(['speciality_id']);
            $table->dropColumn(['doctor_id', 'speciality_id']);
            $table->bigInteger('doctor_id');
            $table->bigInteger('speciality_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctor_specialities', function (Blueprint $table) {;
            $table->dropColumn(['doctor_id', 'speciality_id']);
            $table->foreignId('doctor_id')->constrained('doctors');
            $table->foreignId('speciality_id')->constrained('specialties');
        });
    }
};
