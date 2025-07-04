<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   /**
    * Run the migrations.
    */
   public function up(): void
   {
      DB::statement("
         INSERT INTO speciality_technologies (speciality_id, technology_id, created_at, updated_at)
         SELECT specialty_id, id, NOW(), NOW()
         FROM technologies
         WHERE specialty_id IS NOT NULL
      ");
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      DB::table('speciality_technologies')->truncate();

   }
};
