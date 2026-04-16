<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['email', 'phone_primary', 'phone_secondary', 'address',
    'instagram_url', 'facebook_url', 'twitter_url', 'tiktok_url'])]
class ContactInfo extends Model
{
    use HasFactory;
}
