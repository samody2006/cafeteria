<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'phone_primary',
        'phone_secondary',
        'address',
        'instagram_url',
        'facebook_url',
        'twitter_url',
    ];
}
