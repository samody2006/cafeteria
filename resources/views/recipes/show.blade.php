@extends('layouts.app')

@section('title', $recipe->title . ' — God\'s Own Cafeteria')
@section('meta_description', $recipe->description ?? $recipe->title)

@push('styles')
<style>
    /* ── Recipe Hero ─────────────────────────────────────────── */
    .recipe-hero {
        position: relative;
        height: 65vh;
        min-height: 480px;
        overflow: hidden;
    }

    .recipe-hero-img {
        width: 100%; height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .recipe-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to top,
            rgba(26,22,18,0.9) 0%,
            rgba(26,22,18,0.3) 50%,
            transparent 100%
        );
    }

    .recipe-hero-content {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 4rem 6vw 3.5rem;
        max-width: 860px;
        animation: fadeUp 0.8s ease forwards;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .recipe-breadcrumb {
        font-size: 0.65rem;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 1rem;
        text-decoration: none;
    }

    .recipe-hero-title {
        font-size: clamp(2.5rem, 6vw, 5rem);
        font-weight: 300;
        line-height: 1.05;
        color: var(--cream);
        margin-bottom: 1rem;
    }

    .recipe-hero-meta {
        font-size: 0.72rem;
        letter-spacing: 0.15em;
        color: rgba(245,240,232,0.55);
        text-transform: uppercase;
    }

    .recipe-hero-meta span { color: rgba(245,240,232,0.3); margin: 0 0.5rem; }

    /* ── Layout ──────────────────────────────────────────────── */
    .recipe-layout {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 0;
        padding: 0 6vw 6rem;
        padding-top: 4rem;
        align-items: start;
        max-width: 1200px;
        margin: 0 auto;
    }

    @media (max-width: 900px) {
        .recipe-layout { grid-template-columns: 1fr; gap: 3rem; }
    }

    /* ── Description ─────────────────────────────────────────── */
    .recipe-description {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.35rem;
        font-style: italic;
        line-height: 1.7;
        color: #4a4038;
        margin-bottom: 3.5rem;
        padding-bottom: 3.5rem;
        border-bottom: 1px solid rgba(184,148,58,0.18);
    }

    /* ── Ingredients ─────────────────────────────────────────── */
    .recipe-sidebar {
        padding-left: 4rem;
        border-left: 1px solid rgba(184,148,58,0.18);
        position: sticky;
        top: 88px;
    }

    @media (max-width: 900px) {
        .recipe-sidebar {
            padding-left: 0;
            border-left: none;
            border-top: 1px solid rgba(184,148,58,0.18);
            padding-top: 2rem;
        }
    }

    .sidebar-section-label {
        font-size: 0.65rem;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 1.5rem;
    }

    .ingredient-list {
        list-style: none;
        padding: 0; margin: 0 0 3rem;
    }

    .ingredient-item {
        padding: 0.7rem 0;
        border-bottom: 1px solid rgba(26,22,18,0.07);
        font-size: 0.9rem;
        line-height: 1.5;
        color: #3a3028;
        display: flex;
        gap: 0.5rem;
    }

    .ingredient-item::before {
        content: '–';
        color: var(--gold);
        flex-shrink: 0;
    }

    /* ── Instructions ────────────────────────────────────────── */
    .steps-section h2 {
        font-size: 2rem;
        margin-bottom: 2.5rem;
    }

    .step {
        display: grid;
        grid-template-columns: 48px 1fr;
        gap: 1.5rem;
        margin-bottom: 3rem;
        align-items: start;
    }

    .step-number {
        font-family: 'Cormorant Garamond', serif;
        font-size: 3rem;
        font-weight: 300;
        color: rgba(184,148,58,0.25);
        line-height: 1;
    }

    .step-text {
        font-size: 0.97rem;
        line-height: 1.9;
        color: #4a4038;
        padding-top: 0.3rem;
    }

    /* ── Related recipes ─────────────────────────────────────── */
    .related-section {
        padding: 5rem 6vw;
        background: var(--warm);
        border-top: 1px solid rgba(184,148,58,0.12);
    }

    .related-section h2 {
        font-size: 2.2rem;
        margin-bottom: 3rem;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 2px;
    }

    .related-card {
        position: relative;
        aspect-ratio: 4/3;
        overflow: hidden;
        background: var(--ink);
    }

    .related-card img {
        width: 100%; height: 100%;
        object-fit: cover;
        opacity: 0.85;
        transition: transform 0.5s ease, opacity 0.3s;
    }

    .related-card:hover img { transform: scale(1.05); opacity: 0.65; }

    .related-card-body {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 1.5rem;
        background: linear-gradient(to top, rgba(26,22,18,0.9) 0%, transparent);
    }

    .related-card-body h3 {
        font-size: 1.2rem;
        color: var(--cream);
    }

    .related-card a {
        position: absolute;
        inset: 0;
    }
</style>
@endpush

@section('content')

    {{-- ── Hero ────────────────────────────────────────────────── --}}
    <div class="recipe-hero">
        <img
            src="{{ $recipe->image ? asset('storage/' . $recipe->image) : asset('images/placeholder.jpg') }}"
            alt="{{ $recipe->title }}"
            class="recipe-hero-img"
        >
        <div class="recipe-hero-overlay"></div>
        <div class="recipe-hero-content">
            <a href="{{ route('recipes.index') }}" class="recipe-breadcrumb">← All Recipes</a>
            <h1 class="recipe-hero-title">{{ $recipe->title }}</h1>
            <p class="recipe-hero-meta">
                {{ $recipe->created_at->format('d M Y') }}
                <span>|</span>
                God's Own Cafeteria
            </p>
        </div>
    </div>

    {{-- ── Body ─────────────────────────────────────────────────── --}}
    <div class="recipe-layout">
        {{-- Main content --}}
        <div>
            @if($recipe->description)
                <p class="recipe-description">{{ $recipe->description }}</p>
            @endif

            {{-- Instructions --}}
            <div class="steps-section">
                <h2>Method</h2>

                @php
                    $steps = is_array($recipe->instructions)
                        ? $recipe->instructions
                        : array_filter(explode("\n", $recipe->instructions));
                    $steps = array_values($steps);
                @endphp

                @foreach($steps as $i => $step)
                    @if(trim($step))
                        <div class="step">
                            <span class="step-number">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <p class="step-text">{{ trim($step) }}</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        {{-- Sidebar / Ingredients --}}
        <aside class="recipe-sidebar">
            <p class="sidebar-section-label">✦ Ingredients</p>
            <ul class="ingredient-list">
                @php
                    $ingredients = is_array($recipe->ingredients)
                        ? $recipe->ingredients
                        : array_filter(explode("\n", $recipe->ingredients));
                @endphp

                @foreach($ingredients as $ingredient)
                    @if(trim($ingredient))
                        <li class="ingredient-item">{{ trim($ingredient) }}</li>
                    @endif
                @endforeach
            </ul>

            <a href="{{ route('recipes.index') }}" class="btn-primary" style="display:block;text-align:center;">
                ← Back to Recipes
            </a>
        </aside>
    </div>

    {{-- ── Related Recipes ─────────────────────────────────────── --}}
    @if(isset($related) && $related->count())
        <div class="related-section">
            <h2>More from the Kitchen</h2>
            <div class="related-grid">
                @foreach($related as $r)
                    <div class="related-card">
                        <img
                            src="{{ $r->image ? asset('storage/' . $r->image) : asset('images/placeholder.jpg') }}"
                            alt="{{ $r->title }}"
                            loading="lazy"
                        >
                        <div class="related-card-body">
                            <h3>{{ $r->title }}</h3>
                        </div>
                        <a href="{{ route('recipes.show', $r->slug) }}" aria-label="{{ $r->title }}"></a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

@endsection
