<?php

namespace App\Models;

use App\Helper;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use Sluggable;
    protected $table='specialties';
    const tableName='specialties';


    public function parent(){
        return $this->belongsTo(Speciality::class,'parent_speciality_id');
    }

    public function subspecialities()
    {
        return $this->hasMany(Speciality::class, 'parent_speciality_id');
    }

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
