<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   /**
    * Run the migrations.
    */
   public function up(): void
   {
      Schema::create('job_requests', function (Blueprint $table) {
         $table->id();
         $table->string('name');
         $table->string('email');
         $table->string('phone_number');
         $table->date('date_of_birth');
         $table->string('gender');
         $table->enum('experience', ['experience', 'fresher']);
         $table->string('old_organization');
         $table->string('current_annual_ctc');
         $table->string('expected_annual_ctc');
         $table->integer('notice_period');
         $table->string('current_designation');
         $table->string('department');
         $table->integer('year_of_experience');
         $table->string('reason_of_change');
         $table->string('institution_name');
         $table->string('degree');
         $table->string('year_of_completion');
         $table->string('percent_or_cgpa');
         $table->text('resume');
         $table->text('message');
         $table->foreignId('job_id')->constrained('jobs');
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::dropIfExists('job_requests');
   }
};
