@extends('layouts.app')

@section('title', 'Chef & Table — Artisanal Recipes & Culinary Art')
@section('meta_description', 'Discover handcrafted recipes, culinary stories, and fine dining experiences by Chef.')

@push('styles')
<style>
    /* ── Hero ─────────────────────────────────────────────────── */
    .hero {
        position: relative;
        height: 100vh;
        min-height: 600px;
        display: flex;
        align-items: flex-end;
        overflow: hidden;
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        background-image: url('{{ asset("images/hero.jpg") }}');
        background-size: cover;
        background-position: center;
        transform: scale(1.05);
        animation: heroZoom 8s ease forwards;
    }

    @keyframes heroZoom {
        to { transform: scale(1); }
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to top,
            rgba(26,22,18,0.88) 0%,
            rgba(26,22,18,0.3) 55%,
            transparent 100%
        );
    }

    .hero-content {
        position: relative;
        z-index: 2;
        padding: 4rem 6vw 5rem;
        max-width: 780px;
        opacity: 0;
        animation: fadeUp 1s 0.4s ease forwards;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .hero-eyebrow {
        font-size: 0.68rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 1rem;
    }

    .hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(3rem, 7vw, 6rem);
        font-weight: 300;
        line-height: 1.05;
        color: var(--cream);
        margin-bottom: 1.5rem;
    }

    .hero-title em { font-style: italic; color: var(--gold); }

    .hero-sub {
        color: rgba(245,240,232,0.65);
        font-size: 0.95rem;
        line-height: 1.8;
        max-width: 480px;
        margin-bottom: 2.5rem;
    }

    .hero-scroll {
        position: absolute;
        bottom: 2.5rem;
        right: 6vw;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        color: rgba(245,240,232,0.5);
        font-size: 0.62rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        animation: bounce 2s 2s ease-in-out infinite;
    }

    .hero-scroll-line {
        width: 1px;
        height: 48px;
        background: linear-gradient(to bottom, transparent, var(--gold));
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50%       { transform: translateY(6px); }
    }

    /* ── Section shared ───────────────────────────────────────── */
    .section { padding: 6rem 6vw; }
    .section-alt { background: var(--warm); }

    .section-header {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 3.5rem;
    }

    .section-header h2 {
        font-size: clamp(2rem, 4vw, 3rem);
        line-height: 1.1;
    }

    .section-header .tag {
        font-size: 0.65rem;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 0.4rem;
    }

    .section-line {
        flex: 1;
        height: 1px;
        background: linear-gradient(to right, var(--gold), transparent);
        opacity: 0.4;
    }

    /* ── Recipe Cards ──────────────────────────────────────────── */
    .recipes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2px;
    }

    .recipe-card {
        position: relative;
        overflow: hidden;
        aspect-ratio: 3/4;
        background: var(--ink);
        cursor: pointer;
    }

    .recipe-card:first-child {
        grid-column: span 2;
        aspect-ratio: 16/9;
    }

    @media (max-width: 768px) {
        .recipe-card:first-child { grid-column: span 1; aspect-ratio: 3/4; }
    }

    .recipe-card-img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.7s ease, opacity 0.4s;
        opacity: 0.9;
    }

    .recipe-card:hover .recipe-card-img {
        transform: scale(1.06);
        opacity: 0.7;
    }

    .recipe-card-body {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 1.5rem;
        background: linear-gradient(to top, rgba(26,22,18,0.92) 0%, transparent 100%);
        transform: translateY(10px);
        transition: transform 0.4s ease;
    }

    .recipe-card:hover .recipe-card-body { transform: translateY(0); }

    .recipe-card-tag {
        font-size: 0.6rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 0.4rem;
    }

    .recipe-card-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.5rem;
        color: var(--cream);
        line-height: 1.2;
        margin-bottom: 0.5rem;
    }

    .recipe-card-meta {
        font-size: 0.7rem;
        color: rgba(245,240,232,0.5);
        letter-spacing: 0.1em;
    }

    .recipe-card-link {
        display: block;
        position: absolute;
        inset: 0;
    }

    /* ── Feature Strip ────────────────────────────────────────── */
    .feature-strip {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0;
        border-top: 1px solid rgba(184,148,58,0.2);
        border-bottom: 1px solid rgba(184,148,58,0.2);
    }

    .feature-item {
        padding: 3rem 2rem;
        text-align: center;
        border-right: 1px solid rgba(184,148,58,0.2);
    }
    .feature-item:last-child { border-right: none; }

    .feature-icon {
        font-size: 2rem;
        margin-bottom: 1rem;
        display: block;
    }

    .feature-item h3 {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
    }

    .feature-item p {
        font-size: 0.82rem;
        line-height: 1.7;
        color: #6b6055;
        max-width: 200px;
        margin: 0 auto;
    }

    @media (max-width: 640px) {
        .feature-strip { grid-template-columns: 1fr; }
        .feature-item { border-right: none; border-bottom: 1px solid rgba(184,148,58,0.2); }
        .feature-item:last-child { border-bottom: none; }
    }

    /* ── Gallery Strip ────────────────────────────────────────── */
    .gallery-strip {
        display: flex;
        gap: 2px;
        overflow: hidden;
    }

    .gallery-thumb {
        flex: 1;
        aspect-ratio: 1;
        overflow: hidden;
        position: relative;
        min-width: 0;
    }

    .gallery-thumb img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
        filter: saturate(0.7);
    }

    .gallery-thumb:hover img {
        transform: scale(1.08);
        filter: saturate(1);
    }

    .gallery-thumb-overlay {
        position: absolute;
        inset: 0;
        background: rgba(26,22,18,0);
        transition: background 0.4s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .gallery-thumb:hover .gallery-thumb-overlay {
        background: rgba(26,22,18,0.3);
    }

    .gallery-thumb-overlay span {
        font-family: 'Cormorant Garamond', serif;
        font-size: 0.85rem;
        color: #fff;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        opacity: 0;
        transition: opacity 0.3s 0.1s;
    }

    .gallery-thumb:hover .gallery-thumb-overlay span { opacity: 1; }

    /* ── Bio Teaser ────────────────────────────────────────────── */
    .bio-teaser {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 540px;
    }

    .bio-image {
        position: relative;
        overflow: hidden;
    }

    .bio-image img {
        width: 100%; height: 100%;
        object-fit: cover;
        object-position: top center;
    }

    .bio-image-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, transparent 70%, var(--cream));
    }

    .bio-text {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 4rem 5vw 4rem 4rem;
    }

    .bio-text .eyebrow {
        font-size: 0.65rem;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 1.2rem;
    }

    .bio-text h2 {
        font-size: clamp(2.2rem, 4vw, 3.5rem);
        line-height: 1.1;
        margin-bottom: 1.5rem;
    }

    .bio-text p {
        font-size: 0.92rem;
        line-height: 1.85;
        color: #5a5048;
        margin-bottom: 2rem;
        max-width: 420px;
    }

    @media (max-width: 768px) {
        .bio-teaser { grid-template-columns: 1fr; }
        .bio-image { height: 320px; }
        .bio-image-overlay { background: linear-gradient(to top, var(--cream) 0%, transparent 60%); }
        .bio-text { padding: 3rem 6vw; }
    }

    /* ── Quote ─────────────────────────────────────────────────── */
    .quote-section {
        padding: 5rem 6vw;
        text-align: center;
        border-top: 1px solid rgba(184,148,58,0.15);
        border-bottom: 1px solid rgba(184,148,58,0.15);
    }

    .pull-quote {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(1.8rem, 4vw, 3.2rem);
        font-style: italic;
        font-weight: 300;
        line-height: 1.35;
        color: var(--ink);
        max-width: 820px;
        margin: 0 auto;
    }

    .pull-quote::before { content: '\201C'; color: var(--gold); }
    .pull-quote::after  { content: '\201D'; color: var(--gold); }

    .quote-author {
        margin-top: 1.5rem;
        font-size: 0.72rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--gold);
    }
</style>
@endpush

@section('content')

    {{-- ── Hero ──────────────────────────────────────────────── --}}
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <p class="hero-eyebrow">✦ Artisan Cuisine</p>
            <h1 class="hero-title">
                Food is <em>art</em><br>written in flavour
            </h1>
            <p class="hero-sub">
                Every dish tells a story — of seasons, memory, and craft.
                Welcome to my kitchen, where tradition meets invention.
            </p>
            <a href="{{ route('recipes.index') }}" class="btn-primary" style="color:var(--cream);border-color:rgba(245,240,232,0.5);">
                Explore Recipes
            </a>
        </div>

        <div class="hero-scroll">
            <div class="hero-scroll-line"></div>
            Scroll
        </div>
    </section>

    {{-- ── Feature Strip ─────────────────────────────────────── --}}
    <div class="feature-strip">
        <div class="feature-item">
            <span class="feature-icon">🌿</span>
            <h3>Seasonal Ingredients</h3>
            <p>Every recipe built around what the earth offers at its peak.</p>
        </div>
        <div class="feature-item">
            <span class="feature-icon">🔥</span>
            <h3>Proven Technique</h3>
            <p>Decades of craft condensed into step-by-step instructions.</p>
        </div>
        <div class="feature-item">
            <span class="feature-icon">📖</span>
            <h3>Culinary Stories</h3>
            <p>Context, history, and passion behind every plate.</p>
        </div>
    </div>

    {{-- ── Recent Recipes ────────────────────────────────────── --}}
    <section class="section">
        <div class="section-header">
            <div>
                <p class="tag">Latest from the kitchen</p>
                <h2>Recent Recipes</h2>
            </div>
            <div class="section-line"></div>
            <a href="{{ route('recipes.index') }}" class="btn-primary" style="white-space:nowrap;">View All</a>
        </div>

        <div class="recipes-grid">
            @forelse($recipes as $recipe)
                <div class="recipe-card">
                    <img
                        src="{{ $recipe->image ? asset('storage/' . $recipe->image) : asset('images/placeholder.jpg') }}"
                        alt="{{ $recipe->title }}"
                        class="recipe-card-img"
                        loading="lazy"
                    >
                    <div class="recipe-card-body">
                        <p class="recipe-card-tag">✦ Recipe</p>
                        <h3 class="recipe-card-title">{{ $recipe->title }}</h3>
                        <p class="recipe-card-meta">{{ $recipe->created_at->format('d M Y') }}</p>
                    </div>
                    <a href="{{ route('recipes.show', $recipe->slug) }}" class="recipe-card-link" aria-label="{{ $recipe->title }}"></a>
                </div>
            @empty
                <p style="color:var(--gold);grid-column:1/-1;text-align:center;padding:4rem 0;font-family:'Cormorant Garamond',serif;font-size:1.4rem;">
                    The first recipe is being crafted…
                </p>
            @endforelse
        </div>
    </section>

    {{-- ── Pull Quote ────────────────────────────────────────── --}}
    <div class="quote-section">
        <p class="pull-quote">
            Cooking is not just feeding the body — it is an act of love, of memory, of pure human expression.
        </p>
        <p class="quote-author">— Chef & Table</p>
    </div>

    {{-- ── Bio Teaser ───────────────────────────────────────── --}}
    <div class="bio-teaser">
        <div class="bio-image">
            <img src="{{ asset('images/chef-portrait.jpg') }}" alt="Chef portrait" loading="lazy">
            <div class="bio-image-overlay"></div>
        </div>
        <div class="bio-text">
            <p class="eyebrow">✦ The Chef</p>
            <h2>A life lived<br><em>at the stove</em></h2>
            <p>
                Born from a family of cooks, trained across three continents, and driven by one belief:
                that great food transforms an ordinary evening into something sacred.
                Every recipe here carries a piece of that journey.
            </p>
            <a href="{{ route('about') }}" class="btn-primary">Read My Story</a>
        </div>
    </div>

    {{-- ── Gallery Strip ─────────────────────────────────────── --}}
    @if($galleryImages && $galleryImages->count())
    <section class="section section-alt">
        <div class="section-header">
            <div>
                <p class="tag">Behind the scenes</p>
                <h2>From the Table</h2>
            </div>
            <div class="section-line"></div>
            <a href="{{ route('gallery') }}" class="btn-primary" style="white-space:nowrap;">Full Gallery</a>
        </div>

        <div class="gallery-strip">
            @foreach($galleryImages->take(5) as $img)
                <div class="gallery-thumb">
                    <img
                        src="{{ asset('storage/' . $img->image_path) }}"
                        alt="{{ $img->caption ?? 'Gallery' }}"
                        loading="lazy"
                    >
                    <div class="gallery-thumb-overlay">
                        <span>{{ $img->caption ?? 'View' }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif

@endsection
