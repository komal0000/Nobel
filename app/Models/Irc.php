<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Irc extends Model
{
    protected $table = 'irc';
    protected $fillable = [
      'title',
      'description'
    ];
}
