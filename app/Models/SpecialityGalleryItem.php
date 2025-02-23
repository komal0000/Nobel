<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialityGalleryItem extends Model
{
    protected $table = 'speciality_gallery_items';

    protected $fillable = [
        'speciality_gallery_id',
        'specialty_id',
        'icon',
        'title',
        'description',
        'extra_data',
    ];
}
