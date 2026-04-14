@extends('layouts.app')

@section('title', 'Recipes — God\'s Own Cafeteria')
@section('meta_description', 'Browse all recipes — handcrafted step-by-step guides from the kitchen.')

@push('styles')
<style>
    /* ── Page Header ─────────────────────────────────────────── */
    .page-header {
        padding: 6rem 6vw 4rem;
        border-bottom: 1px solid rgba(184,148,58,0.15);
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .page-header .header-left h1 {
        font-size: clamp(2.8rem, 5.5vw, 4.5rem);
        line-height: 1.05;
        margin-bottom: 0.5rem;
    }

    .page-header .eyebrow {
        font-size: 0.65rem;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 0.6rem;
        font-weight: 500;
    }

    .page-header h1 em { font-style: italic; color: var(--gold); font-weight: 300; }

    .page-header .header-right {
        display: flex;
        align-items: flex-end;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .page-header p {
        max-width: 320px;
        font-size: 0.9rem;
        line-height: 1.75;
        color: #7a6f67;
    }

    /* ── Filter Bar ──────────────────────────────────────────── */
    .filter-bar {
        padding: 1.8rem 6vw;
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        border-bottom: 1px solid rgba(184,148,58,0.12);
        background: linear-gradient(to right, var(--cream) 0%, rgba(232,220,200,0.5) 100%);
        align-items: center;
    }

    .filter-bar-label {
        font-size: 0.7rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: #8b7355;
        margin-right: 0.5rem;
        font-weight: 500;
    }

    .filter-btn {
        padding: 0.55rem 1.3rem;
        border: 1.5px solid rgba(26,22,18,0.3);
        font-size: 0.7rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        background: rgba(255, 255, 255, 0.8);
        color: var(--ink);
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        font-weight: 500;
        border-radius: 3px;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: var(--ink);
        color: var(--cream);
        border-color: var(--ink);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(26,22,18,0.12);
    }

    /* ── Recipe Grid ─────────────────────────────────────────── */
    .recipes-listing {
        padding: 4rem 6vw 6rem;
    }

    .recipes-listing-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 3rem 2rem;
    }

    /* Individual card */
    .recipe-list-card {
        cursor: pointer;
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .recipe-list-card:hover {
        transform: translateY(-6px);
    }

    .recipe-list-card-img-wrap {
        position: relative;
        overflow: hidden;
        aspect-ratio: 1.2/1;
        margin-bottom: 1.5rem;
        border-radius: 4px;
        background: rgba(184,148,58,0.08);
    }

    .recipe-list-card-img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.7s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.4s;
        opacity: 1;
    }

    .recipe-list-card:hover .recipe-list-card-img {
        transform: scale(1.08) rotate(1deg);
        opacity: 0.9;
    }

    .recipe-list-card-tag {
        position: absolute;
        top: 1.2rem;
        left: 1.2rem;
        background: rgba(26,22,18,0.92);
        color: var(--gold);
        font-size: 0.6rem;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        padding: 0.4rem 0.9rem;
        border-radius: 2px;
        font-weight: 600;
    }

    .recipe-list-card h2 {
        font-size: 1.6rem;
        font-family: 'Cormorant Garamond', serif;
        line-height: 1.25;
        margin-bottom: 0.6rem;
        transition: color 0.3s ease;
        color: var(--ink);
    }

    .recipe-list-card:hover h2 {
        color: var(--gold);
    }

    .recipe-list-card p {
        font-size: 0.87rem;
        line-height: 1.7;
        color: #7a6f67;
        margin-bottom: 1.2rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .recipe-list-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.7rem;
        letter-spacing: 0.12em;
        color: #a89a8f;
        border-top: 1.5px solid rgba(184,148,58,0.18);
        padding-top: 1rem;
    }

    .recipe-list-card-link {
        display: block;
        text-decoration: none;
        color: inherit;
    }

    /* ── Empty state ─────────────────────────────────────────── */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 5rem 0;
    }

    .empty-state h3 {
        font-size: 2rem;
        color: var(--gold);
        margin-bottom: 1rem;
    }

    .empty-state p { font-size: 0.9rem; color: #9a8e84; }

    /* ── Pagination ──────────────────────────────────────────── */
    .pagination-wrap {
        margin-top: 4rem;
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    .pagination-wrap .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px; height: 38px;
        border: 1px solid rgba(26,22,18,0.2);
        font-size: 0.78rem;
        color: var(--ink);
        text-decoration: none;
        transition: all 0.2s;
    }

    .pagination-wrap .page-link:hover,
    .pagination-wrap .page-link.active {
        background: var(--ink);
        color: var(--cream);
        border-color: var(--ink);
    }

    .pagination-wrap .page-link.disabled {
        opacity: 0.3;
        pointer-events: none;
    }
</style>
@endpush

@section('content')

    {{-- ── Page Header ─────────────────────────────────────────── --}}
    <div class="page-header">
        <div>
            <p class="eyebrow">✦ God's Own Cafeteria</p>
            <h1>All <em>Recipes</em></h1>
        </div>
        <p style="font-size:0.85rem;color:#9a8e84;max-width:360px;line-height:1.7;">
            Each recipe is a complete story — ingredients, method, and the reason it matters.
        </p>
    </div>

    {{-- ── Filter Bar ─────────────────────────────────────────── --}}
    {{-- Extend with categories later --}}
    <div class="filter-bar">
        <a href="{{ route('recipes.index') }}" class="filter-btn active">All</a>
        {{-- @foreach($categories ?? [] as $cat) --}}
        {{-- <a href="{{ route('recipes.index', ['category' => $cat->slug]) }}" class="filter-btn">{{ $cat->name }}</a> --}}
        {{-- @endforeach --}}
    </div>

    {{-- ── Recipes Listing ─────────────────────────────────────── --}}
    <div class="recipes-listing">
        <div class="recipes-listing-grid">
            @forelse($recipes as $recipe)
                <a href="{{ route('recipes.show', $recipe->slug) }}" class="recipe-list-card-link">
                    <article class="recipe-list-card">
                        <div class="recipe-list-card-img-wrap">
                            @php $cover = $recipe->coverImagePath(); @endphp
                            <img
                                src="{{ $cover ? asset('storage/' . $cover) : asset('images/placeholder.jpg') }}"
                                alt="{{ $recipe->title }}"
                                class="recipe-list-card-img"
                                loading="lazy"
                            >
                            <span class="recipe-list-card-tag">Recipe</span>
                        </div>

                        <h2>{{ $recipe->title }}</h2>
                        @if($recipe->description)
                            <p>{{ $recipe->description }}</p>
                        @endif

                        <div class="recipe-list-card-footer">
                            <span>{{ $recipe->created_at->format('d M Y') }}</span>
                            <span style="color:var(--gold);letter-spacing:0.05em;">Read →</span>
                        </div>
                    </article>
                </a>
            @empty
                <div class="empty-state">
                    <h3>First recipes coming soon…</h3>
                    <p>Check back shortly for handcrafted culinary guides.</p>
                </div>
            @endforelse
        </div>

        {{-- ── Pagination ─────────────────────────────────── --}}
        @if($recipes->hasPages())
            <div class="pagination-wrap">
                {{-- Prev --}}
                @if($recipes->onFirstPage())
                    <span class="page-link disabled">‹</span>
                @else
                    <a href="{{ $recipes->previousPageUrl() }}" class="page-link">‹</a>
                @endif

                {{-- Pages --}}
                @foreach($recipes->getUrlRange(1, $recipes->lastPage()) as $page => $url)
                    @if($page == $recipes->currentPage())
                        <span class="page-link active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next --}}
                @if($recipes->hasMorePages())
                    <a href="{{ $recipes->nextPageUrl() }}" class="page-link">›</a>
                @else
                    <span class="page-link disabled">›</span>
                @endif
            </div>
        @endif
    </div>

@endsection
