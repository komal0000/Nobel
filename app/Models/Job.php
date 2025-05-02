<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
   use Sluggable;
   protected $fillable = [
      'title',
      'slug'
   ];

   public function sluggable(): array
   {
      return [
         'slug' => [
            'source' => 'title',
         ]
      ];
   }
   public function shouldSlugUpdate()
   {
      return true;
   }
}
