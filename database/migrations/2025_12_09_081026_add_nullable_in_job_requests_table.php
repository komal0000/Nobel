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
        Schema::table('job_requests', function (Blueprint $table) {
            $table->string('old_organization')->nullable()->change();
            $table->string('current_annual_ctc')->nullable()->change();
            $table->string('expected_annual_ctc')->nullable()->change();
            $table->integer('notice_period')->nullable()->change();
            $table->string('current_designation')->nullable()->change();
            $table->string('department')->nullable()->change();
            $table->integer('year_of_experience')->nullable()->change();
            $table->string('reason_of_change')->nullable()->change();
            $table->string('institution_name')->nullable()->change();
            $table->string('degree')->nullable()->change();
            $table->string('year_of_completion')->nullable()->change();
            $table->string('percent_or_cgpa')->nullable()->change();
            $table->text('message')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_requests', function (Blueprint $table) {
            // Revert columns back to non-nullable
            $table->string('old_organization')->change();
            $table->string('current_annual_ctc')->change();
            $table->string('expected_annual_ctc')->change();
            $table->integer('notice_period')->change();
            $table->string('current_designation')->change();
            $table->string('department')->change();
            $table->integer('year_of_experience')->change();
            $table->string('reason_of_change')->change();
            $table->string('institution_name')->change();
            $table->string('degree')->change();
            $table->string('year_of_completion')->change();
            $table->string('percent_or_cgpa')->change();
            $table->text('message')->change();
        });
    }
};
