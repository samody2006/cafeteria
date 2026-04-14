<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable(['path', 'alt_text', 'sort_order'])]
class Media extends Model
{
    use HasFactory;

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }
}
