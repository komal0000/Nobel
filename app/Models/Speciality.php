<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    //
    protected $table='specialties';
    const tableName='specialties';


    public function parent(){
        return $this->belongsTo(Speciality::class,'parent_speciality_id');
    }

    public function subspecialities()
    {
        return $this->hasMany(Speciality::class, 'parent_speciality_id');
    }
}
