@extends('layouts.app')

@section('title', 'About — Chef & Table')
@section('meta_description', 'The story, philosophy, and journey of the chef behind every dish.')

@push('styles')
<style>
    /* ── Page Hero ───────────────────────────────────────────── */
    .about-hero {
        position: relative;
        height: 55vh;
        min-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        text-align: center;
    }

    .about-hero-bg {
        position: absolute;
        inset: 0;
        background-image: url('{{ asset("images/about-hero.jpg") }}');
        background-size: cover;
        background-position: center 30%;
    }

    .about-hero-overlay {
        position: absolute;
        inset: 0;
        background: rgba(26,22,18,0.62);
    }

    .about-hero-content {
        position: relative;
        z-index: 2;
        color: var(--cream);
        animation: fadeUp 0.9s ease forwards;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .about-hero-content .eyebrow {
        font-size: 0.65rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 1rem;
    }

    .about-hero-content h1 {
        font-size: clamp(3rem, 7vw, 5.5rem);
        font-weight: 300;
        line-height: 1.05;
    }

    .about-hero-content h1 em { font-style: italic; color: var(--gold); }

    /* ── Bio Section ─────────────────────────────────────────── */
    .bio-section {
        display: grid;
        grid-template-columns: 380px 1fr;
        gap: 6rem;
        padding: 7rem 6vw;
        align-items: start;
    }

    @media (max-width: 900px) {
        .bio-section { grid-template-columns: 1fr; gap: 3rem; }
    }

    .bio-portrait-wrap {
        position: sticky;
        top: 88px;
    }

    .bio-portrait {
        width: 100%;
        aspect-ratio: 3/4;
        object-fit: cover;
        object-position: top center;
        display: block;
    }

    .bio-portrait-caption {
        margin-top: 1rem;
        font-size: 0.7rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--gold);
        text-align: center;
    }

    .bio-portrait-caption::before,
    .bio-portrait-caption::after {
        content: ' — ';
        color: rgba(184,148,58,0.4);
    }

    /* Bio text */
    .bio-text h2 {
        font-size: clamp(2rem, 4vw, 3rem);
        line-height: 1.1;
        margin-bottom: 0.5rem;
    }

    .bio-text .subtitle {
        font-size: 0.75rem;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 2.5rem;
    }

    .bio-text p {
        font-size: 1rem;
        line-height: 1.9;
        color: #4a4038;
        margin-bottom: 1.5rem;
    }

    .bio-text p:first-of-type::first-letter {
        font-family: 'Cormorant Garamond', serif;
        font-size: 4rem;
        font-weight: 300;
        float: left;
        line-height: 0.75;
        margin-right: 0.15em;
        margin-top: 0.12em;
        color: var(--gold);
    }

    /* ── Milestones ──────────────────────────────────────────── */
    .milestones {
        padding: 0;
        list-style: none;
        border-top: 1px solid rgba(184,148,58,0.2);
        margin-top: 2.5rem;
    }

    .milestone-item {
        display: grid;
        grid-template-columns: 80px 1fr;
        gap: 1.5rem;
        align-items: baseline;
        padding: 1.5rem 0;
        border-bottom: 1px solid rgba(184,148,58,0.12);
    }

    .milestone-year {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.2rem;
        color: var(--gold);
        font-weight: 300;
    }

    .milestone-desc {
        font-size: 0.88rem;
        line-height: 1.6;
        color: #5a5048;
    }

    /* ── Philosophy ──────────────────────────────────────────── */
    .philosophy {
        background: var(--ink);
        color: var(--cream);
        padding: 7rem 6vw;
        text-align: center;
    }

    .philosophy .eyebrow {
        font-size: 0.65rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 1.5rem;
    }

    .philosophy h2 {
        font-size: clamp(2.5rem, 5vw, 4rem);
        margin-bottom: 3rem;
        color: var(--cream);
    }

    .philosophy-pillars {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 3rem;
        max-width: 900px;
        margin: 0 auto;
    }

    .pillar h3 {
        font-size: 1.4rem;
        color: var(--gold);
        margin-bottom: 0.75rem;
    }

    .pillar p {
        font-size: 0.85rem;
        line-height: 1.8;
        color: rgba(245,240,232,0.6);
    }

    /* ── Stats ───────────────────────────────────────────────── */
    .stats-bar {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        background: var(--warm);
        border-top: 1px solid rgba(184,148,58,0.2);
        border-bottom: 1px solid rgba(184,148,58,0.2);
    }

    .stat-item {
        padding: 3rem 1.5rem;
        text-align: center;
        border-right: 1px solid rgba(184,148,58,0.2);
    }
    .stat-item:last-child { border-right: none; }

    .stat-number {
        font-family: 'Cormorant Garamond', serif;
        font-size: 3rem;
        font-weight: 300;
        color: var(--gold);
        line-height: 1;
        display: block;
    }

    .stat-label {
        font-size: 0.68rem;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: var(--ink);
        margin-top: 0.5rem;
        display: block;
    }

    @media (max-width: 640px) {
        .stats-bar { grid-template-columns: 1fr 1fr; }
        .stat-item:nth-child(2) { border-right: none; }
        .stat-item:nth-child(3), .stat-item:nth-child(4) {
            border-top: 1px solid rgba(184,148,58,0.2);
        }
    }
</style>
@endpush

@section('content')

    {{-- ── Page Hero ──────────────────────────────────────────── --}}
    <div class="about-hero">
        <div class="about-hero-bg"></div>
        <div class="about-hero-overlay"></div>
        <div class="about-hero-content">
            <p class="eyebrow">✦ The Story</p>
            <h1>Behind the <em>Apron</em></h1>
        </div>
    </div>

    {{-- ── Stats Bar ───────────────────────────────────────────── --}}
    <div class="stats-bar">
        <div class="stat-item">
            <span class="stat-number">18</span>
            <span class="stat-label">Years Cooking</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">3</span>
            <span class="stat-label">Continents Trained</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">{{ $totalRecipes ?? '120' }}+</span>
            <span class="stat-label">Recipes Published</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">∞</span>
            <span class="stat-label">Meals Shared</span>
        </div>
    </div>

    {{-- ── Biography ───────────────────────────────────────────── --}}
    <div class="bio-section">
        <div class="bio-portrait-wrap">
            <img
                src="{{ asset('images/chef-portrait-full.jpg') }}"
                alt="Chef portrait"
                class="bio-portrait"
            >
            <p class="bio-portrait-caption">Chef & Author</p>
        </div>

        <div class="bio-text">
            <p class="subtitle">✦ Biography</p>
            <h2>A Culinary Life,<br><em>Fully Lived</em></h2>

            <p>
                {{ $chef->bio_intro ?? 'My relationship with food began before I could reach the kitchen counter — standing on a wooden stool beside my grandmother, watching her hands move with a confidence that needed no recipe. That kitchen was the world to me: warm, fragrant, alive.' }}
            </p>

            <p>
                {{ $chef->bio_middle ?? 'Formal training brought discipline. Years at Le Cordon Bleu sharpened instinct into technique. Stages in Tokyo, Marrakesh, and São Paulo taught me that every cuisine is a civilisation\'s autobiography — written in spice, fire, and time.' }}
            </p>

            <p>
                {{ $chef->bio_closing ?? 'Today I cook, write, and teach. I believe the best meals are made with honest ingredients, unhurried intention, and someone worth feeding. This website is my open kitchen — come in, explore, and cook something beautiful.' }}
            </p>

            {{-- Milestones --}}
            @if(isset($milestones) && $milestones->count())
            <ul class="milestones">
                @foreach($milestones as $m)
                    <li class="milestone-item">
                        <span class="milestone-year">{{ $m->year }}</span>
                        <span class="milestone-desc">{{ $m->description }}</span>
                    </li>
                @endforeach
            </ul>
            @else
            <ul class="milestones">
                <li class="milestone-item">
                    <span class="milestone-year">2006</span>
                    <span class="milestone-desc">Enrolled at Le Cordon Bleu, Paris. First Michelin kitchen.</span>
                </li>
                <li class="milestone-item">
                    <span class="milestone-year">2010</span>
                    <span class="milestone-desc">Travelled through Southeast Asia studying street food traditions.</span>
                </li>
                <li class="milestone-item">
                    <span class="milestone-year">2014</span>
                    <span class="milestone-desc">Opened first pop-up restaurant; 400-person waitlist in week one.</span>
                </li>
                <li class="milestone-item">
                    <span class="milestone-year">2018</span>
                    <span class="milestone-desc">Published debut cookbook: <em>The Table Between Us</em>.</span>
                </li>
                <li class="milestone-item">
                    <span class="milestone-year">2022</span>
                    <span class="milestone-desc">Launched Chef & Table to share recipes and culinary stories online.</span>
                </li>
            </ul>
            @endif
        </div>
    </div>

    {{-- ── Philosophy ──────────────────────────────────────────── --}}
    <div class="philosophy">
        <p class="eyebrow">✦ How I Cook</p>
        <h2>My Culinary <em>Philosophy</em></h2>

        <div class="philosophy-pillars">
            <div class="pillar">
                <h3>Respect the Ingredient</h3>
                <p>Start with the best, use every part, waste nothing. The ingredient is the author; the cook is its editor.</p>
            </div>
            <div class="pillar">
                <h3>Master the Basics</h3>
                <p>A perfect stock, a proper roux, a confident knife hold — fundamentals unlock everything else.</p>
            </div>
            <div class="pillar">
                <h3>Cook for Someone</h3>
                <p>Even a solitary dinner is a conversation — with memory, with hunger, with the self. Intention transforms ingredients.</p>
            </div>
            <div class="pillar">
                <h3>Stay Curious</h3>
                <p>The world's cuisines are infinite. There is always a technique to learn, a flavour pairing to discover.</p>
            </div>
        </div>
    </div>

@endsection
