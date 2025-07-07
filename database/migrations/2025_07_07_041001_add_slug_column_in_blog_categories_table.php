<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
   /**
    * Run the migrations.
    */
   public function up(): void
   {
      Schema::table('blog_categories', function (Blueprint $table) {
         $table->string('slug')->nullable()->unique();
      });

      $categories = DB::table('blog_categories')->get();

      foreach ($categories as $category) {
         DB::table('blog_categories')
            ->where('id', $category->id)
            ->update([
                  'slug' => Str::slug($category->title),
               ]);
      }
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::table('blog_categories', function (Blueprint $table) {
         $table->dropColumn('slug');
      });
   }
};
