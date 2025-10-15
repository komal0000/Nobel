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
         Schema::create('queue_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index(); // queue name
            $table->longText('payload');     // serialized job
            $table->tinyInteger('attempts')->unsigned()->default(0); // retry attempts
            $table->unsignedInteger('reserved_at')->nullable();      // when job is reserved
            $table->unsignedInteger('available_at');                // when job can run
            $table->unsignedInteger('created_at');                  // when job created
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queue_jobs');
    }
};
