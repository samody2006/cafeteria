<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

#[Fillable(['title', 'slug', 'description', 'ingredients', 'instructions', 'image', 'is_published',])]
class Recipe extends Model
{
    use HasFactory;

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable')->orderBy('sort_order')->orderBy('id');
    }

    /**
        * Store uploaded files as media for this recipe.
        *
        * @param  array<int, UploadedFile|null>  $files
        */
    public function addMediaFiles(array $files): void
    {
        foreach ($files as $file) {
            if (! $file instanceof UploadedFile) {
                continue;
            }
            $path = $file->store('recipes', 'public');
            $this->media()->create(['path' => $path]);
        }
    }

    public function coverImagePath(): ?string
    {
        if ($this->image) {
            return $this->image;
        }

        return $this->media()->value('path');
    }
}
