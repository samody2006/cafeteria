@extends('layouts.app')

@section('title', 'Edit — ' . $recipe->title)

@push('styles')
<style>
    .form-wrapper {
        max-width: 820px;
        margin: 0 auto;
        padding: 4rem 2rem 6rem;
    }

    .form-header {
        margin-bottom: 3rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(184,148,58,0.2);
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .form-header .eyebrow {
        font-size: 0.65rem;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 0.4rem;
    }

    .form-header h1 { font-size: 2.2rem; line-height: 1.1; }

    .field-group { margin-bottom: 2rem; }

    .field-label {
        display: block;
        font-size: 0.65rem;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: var(--ink);
        margin-bottom: 0.6rem;
        font-weight: 400;
    }

    .field-label .required { color: var(--gold); margin-left: 2px; }

    .field-input,
    .field-textarea {
        width: 100%;
        background: transparent;
        border: 1px solid rgba(26,22,18,0.25);
        border-bottom-width: 2px;
        padding: 0.75rem 1rem;
        font-family: 'Jost', sans-serif;
        font-size: 0.95rem;
        font-weight: 300;
        color: var(--ink);
        outline: none;
        transition: border-color 0.2s;
        border-radius: 0;
        -webkit-appearance: none;
    }

    .field-input:focus,
    .field-textarea:focus { border-color: var(--gold); }

    .field-textarea { resize: vertical; min-height: 140px; line-height: 1.7; }

    .field-hint  { font-size: 0.75rem; color: #9a8e84; margin-top: 0.4rem; }
    .field-error { font-size: 0.75rem; color: var(--rust); margin-top: 0.4rem; }

    /* Current image */
    .current-image-wrap {
        margin-bottom: 1rem;
    }

    .current-image-label {
        font-size: 0.65rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: #9a8e84;
        margin-bottom: 0.4rem;
    }

    .current-image {
        max-width: 320px;
        max-height: 220px;
        object-fit: cover;
        display: block;
        border: 1px solid rgba(184,148,58,0.2);
    }

    .image-preview-wrap { margin-top: 1rem; }

    .image-preview {
        max-width: 280px;
        max-height: 200px;
        object-fit: cover;
        display: block;
        border: 1px solid rgba(184,148,58,0.2);
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
        padding-top: 2rem;
        border-top: 1px solid rgba(184,148,58,0.15);
        flex-wrap: wrap;
    }

    .danger-zone {
        margin-top: 4rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(139,58,42,0.2);
    }

    .danger-zone h3 {
        font-size: 0.9rem;
        color: var(--rust);
        letter-spacing: 0.1em;
        margin-bottom: 0.75rem;
    }

    .btn-danger {
        padding: 0.5rem 1.5rem;
        background: transparent;
        border: 1px solid var(--rust);
        font-size: 0.68rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--rust);
        cursor: pointer;
        font-family: 'Jost', sans-serif;
        transition: all 0.2s;
    }

    .btn-danger:hover {
        background: var(--rust);
        color: #fff;
    }
</style>
@endpush

@section('content')

    <div class="form-wrapper">
        <div class="form-header">
            <div>
                <p class="eyebrow">✦ Editing</p>
                <h1>{{ $recipe->title }}</h1>
            </div>
            <a href="{{ route('recipes.show', $recipe->slug) }}" target="_blank" style="font-size:0.72rem;letter-spacing:0.18em;text-transform:uppercase;color:var(--gold);text-decoration:none;">
                View Live →
            </a>
        </div>

        <form
            action="{{ route('admin.recipes.update', $recipe->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="field-group">
                <label class="field-label" for="title">
                    Recipe Title <span class="required">*</span>
                </label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    class="field-input"
                    value="{{ old('title', $recipe->title) }}"
                    required
                >
                @error('title')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="field-group">
                <label class="field-label" for="description">Short Description</label>
                <textarea id="description" name="description" class="field-textarea" rows="3">{{ old('description', $recipe->description) }}</textarea>
                @error('description')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Ingredients --}}
            <div class="field-group">
                <label class="field-label" for="ingredients">
                    Ingredients <span class="required">*</span>
                </label>
                <textarea id="ingredients" name="ingredients" class="field-textarea" rows="8" required>{{ old('ingredients', $recipe->ingredients) }}</textarea>
                <p class="field-hint">One ingredient per line.</p>
                @error('ingredients')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Instructions --}}
            <div class="field-group">
                <label class="field-label" for="instructions">
                    Instructions <span class="required">*</span>
                </label>
                <textarea id="instructions" name="instructions" class="field-textarea" rows="12" required>{{ old('instructions', $recipe->instructions) }}</textarea>
                <p class="field-hint">One step per line.</p>
                @error('instructions')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Image --}}
            <div class="field-group">
                <label class="field-label" for="image">Replace Image</label>

                @if($recipe->image)
                    <div class="current-image-wrap">
                        <p class="current-image-label">Current Image</p>
                        <img
                            src="{{ asset('storage/' . $recipe->image) }}"
                            alt="{{ $recipe->title }}"
                            class="current-image"
                        >
                    </div>
                @endif

                <input
                    type="file"
                    id="image"
                    name="image"
                    class="field-input"
                    accept="image/jpeg,image/png,image/webp"
                    onchange="previewImage(this)"
                    style="padding:0.5rem;cursor:pointer;"
                >
                <p class="field-hint">Leave blank to keep the existing image. Max 2 MB.</p>
                @error('image')
                    <p class="field-error">{{ $message }}</p>
                @enderror

                <div id="imagePreviewWrap" class="image-preview-wrap" style="display:none;">
                    <p class="current-image-label">New Image Preview</p>
                    <img id="imagePreview" class="image-preview" src="" alt="Preview">
                </div>
            </div>

            {{-- Actions --}}
            <div class="form-actions">
                <button type="submit" class="btn-gold">Save Changes</button>
                <a href="{{ route('admin.recipes.index') }}" class="btn-primary">Cancel</a>
            </div>
        </form>

        {{-- Danger Zone --}}
        <div class="danger-zone">
            <h3>Danger Zone</h3>
            <form
                action="{{ route('admin.recipes.destroy', $recipe->id) }}"
                method="POST"
                onsubmit="return confirm('Permanently delete \'{{ addslashes($recipe->title) }}\'? This cannot be undone.')"
            >
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">Delete This Recipe</button>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    function previewImage(input) {
        const wrap    = document.getElementById('imagePreviewWrap');
        const preview = document.getElementById('imagePreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                wrap.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
