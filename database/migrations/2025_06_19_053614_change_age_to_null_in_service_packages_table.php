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
      Schema::table('service_packages', function (Blueprint $table) {
         $table->string('age')->nullable()->change();
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::table('service_packages', function (Blueprint $table) {
         $table->string('age')->nullable(false)->change();
      });
   }
};
