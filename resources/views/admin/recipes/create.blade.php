@extends('layouts.app')

@section('title', 'Create Recipe — Admin')

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
    }

    .form-header .eyebrow {
        font-size: 0.65rem;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 0.4rem;
    }

    .form-header h1 { font-size: 2.5rem; }

    /* Field groups */
    .field-group {
        margin-bottom: 2rem;
    }

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
    .field-textarea:focus {
        border-color: var(--gold);
    }

    .field-textarea {
        resize: vertical;
        min-height: 140px;
        line-height: 1.7;
    }

    .field-hint {
        font-size: 0.75rem;
        color: #9a8e84;
        margin-top: 0.4rem;
    }

    .field-error {
        font-size: 0.75rem;
        color: var(--rust);
        margin-top: 0.4rem;
    }

    /* Image preview */
    .image-preview-wrap {
        margin-top: 1rem;
        position: relative;
        display: inline-block;
    }

    .image-preview {
        max-width: 280px;
        max-height: 200px;
        object-fit: cover;
        display: block;
        border: 1px solid rgba(184,148,58,0.2);
    }

    .image-preview-label {
        font-size: 0.65rem;
        letter-spacing: 0.15em;
        color: #9a8e84;
        text-transform: uppercase;
        margin-bottom: 0.4rem;
    }

    /* Grid fields */
    .fields-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    @media (max-width: 600px) {
        .fields-row { grid-template-columns: 1fr; }
    }

    /* Actions */
    .form-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
        padding-top: 2rem;
        border-top: 1px solid rgba(184,148,58,0.15);
        flex-wrap: wrap;
    }
</style>
@endpush

@section('content')

    <div class="form-wrapper">
        <div class="form-header">
            <p class="eyebrow">✦ Admin</p>
            <h1>Create Recipe</h1>
        </div>

        <form
            action="{{ route('admin.recipes.store') }}"
            method="POST"
            enctype="multipart/form-data"
            id="recipeForm"
        >
            @csrf

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
                    value="{{ old('title') }}"
                    placeholder="e.g. Slow-Braised Lamb Shoulder with Harissa"
                    required
                >
                @error('title')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="field-group">
                <label class="field-label" for="description">
                    Short Description
                </label>
                <textarea
                    id="description"
                    name="description"
                    class="field-textarea"
                    rows="3"
                    placeholder="A brief, enticing introduction to this dish…"
                >{{ old('description') }}</textarea>
                <p class="field-hint">Shown on recipe cards and in search results.</p>
                @error('description')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Ingredients --}}
            <div class="field-group">
                <label class="field-label" for="ingredients">
                    Ingredients <span class="required">*</span>
                </label>
                <textarea
                    id="ingredients"
                    name="ingredients"
                    class="field-textarea"
                    rows="8"
                    placeholder="One ingredient per line:&#10;500g lamb shoulder&#10;2 tbsp harissa paste&#10;1 preserved lemon…"
                    required
                >{{ old('ingredients') }}</textarea>
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
                <textarea
                    id="instructions"
                    name="instructions"
                    class="field-textarea"
                    rows="12"
                    placeholder="One step per line:&#10;Preheat the oven to 160°C.&#10;Season the lamb generously with salt and pepper…"
                    required
                >{{ old('instructions') }}</textarea>
                <p class="field-hint">One step per line — each line becomes a numbered instruction.</p>
                @error('instructions')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Image --}}
            <div class="field-group">
                <label class="field-label" for="image">
                    Recipe Image
                </label>
                <input
                    type="file"
                    id="image"
                    name="image"
                    class="field-input"
                    accept="image/jpeg,image/png,image/webp"
                    onchange="previewImage(this)"
                    style="padding: 0.5rem; cursor:pointer;"
                >
                <p class="field-hint">JPG, PNG or WebP. Max 2 MB. Landscape ratio (4:3 or 16:9) recommended.</p>
                @error('image')
                    <p class="field-error">{{ $message }}</p>
                @enderror

                <div id="imagePreviewWrap" class="image-preview-wrap" style="display:none;">
                    <p class="image-preview-label">Preview</p>
                    <img id="imagePreview" class="image-preview" src="" alt="Preview">
                </div>
            </div>

            {{-- Actions --}}
            <div class="form-actions">
                <button type="submit" class="btn-gold">Publish Recipe</button>
                <a href="{{ route('admin.recipes.index') }}" class="btn-primary">Cancel</a>
            </div>
        </form>
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
