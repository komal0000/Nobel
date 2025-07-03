<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class GalleryType extends Model
{
   use Sluggable;

   protected $fillable = [
      'title',
      'slug'
   ];
   protected $table = 'gallery_types';

   public function sluggable(): array
   {
      return [
         'slug' => [
            'source' => 'title',
            'onUpdate' => true
         ]
      ];
   }
   public function shouldSlugUpdate()
   {
      return true;
   }
}
