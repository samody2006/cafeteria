<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'ingredients',
        'instructions',
        'image',
    ];
}
