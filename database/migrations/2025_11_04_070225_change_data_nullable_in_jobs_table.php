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
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
            $table->string('type')->nullable()->change();
            $table->string('location')->nullable()->change();
            $table->integer('date')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->text('qualification')->nullable()->change();
            $table->string('experience')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('title');
            $table->string('type');
            $table->string('location');
            $table->integer('date');
            $table->text('description');
            $table->text('qualification');
            $table->string('experience');
        });
    }
};
