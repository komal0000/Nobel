<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialityGalleryItem extends Model
{
    use HasFactory;

    protected $table = 'speciality_gallery_items';

    protected $fillable = [
        'specialty_gallery_id',
        'specialty_id',
        'icon',
        'title',
        'description',
        'extra_data',
    ];
}
