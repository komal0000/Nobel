<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use Sluggable;

    const table_name = 'doctors';

    protected $table = self::table_name;
    protected $fillable = [
        'title',
        'slug'
    ];

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
