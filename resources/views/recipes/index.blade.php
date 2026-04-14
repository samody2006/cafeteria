@extends('layouts.app')

@section('title', 'Recipes — God\'s Own Cafeteria')
@section('meta_description', 'Browse all recipes — handcrafted step-by-step guides from the kitchen.')

@push('styles')
<style>
    /* ── Page Header ─────────────────────────────────────────── */
    .page-header {
        padding: 5rem 6vw 3rem;
        border-bottom: 1px solid rgba(184,148,58,0.15);
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .page-header .eyebrow {
        font-size: 0.65rem;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 0.5rem;
    }

    .page-header h1 {
        font-size: clamp(2.5rem, 5vw, 4rem);
        line-height: 1;
    }

    .page-header h1 em { font-style: italic; }

    /* ── Filter Bar ──────────────────────────────────────────── */
    .filter-bar {
        padding: 1.5rem 6vw;
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        border-bottom: 1px solid rgba(184,148,58,0.1);
        background: var(--warm);
    }

    .filter-btn {
        padding: 0.35rem 1rem;
        border: 1px solid rgba(26,22,18,0.2);
        font-size: 0.68rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        background: transparent;
        cursor: pointer;
        color: var(--ink);
        text-decoration: none;
        transition: all 0.2s;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: var(--ink);
        color: var(--cream);
        border-color: var(--ink);
    }

    /* ── Recipe Grid ─────────────────────────────────────────── */
    .recipes-listing {
        padding: 4rem 6vw 6rem;
    }

    .recipes-listing-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 3rem 2.5rem;
    }

    /* Individual card */
    .recipe-list-card {
        cursor: pointer;
    }

    .recipe-list-card-img-wrap {
        position: relative;
        overflow: hidden;
        aspect-ratio: 4/3;
        margin-bottom: 1.25rem;
    }

    .recipe-list-card-img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .recipe-list-card:hover .recipe-list-card-img {
        transform: scale(1.05);
    }

    .recipe-list-card-tag {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: var(--ink);
        color: var(--gold);
        font-size: 0.6rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        padding: 0.3rem 0.75rem;
    }

    .recipe-list-card h2 {
        font-size: 1.55rem;
        line-height: 1.2;
        margin-bottom: 0.5rem;
        transition: color 0.2s;
    }

    .recipe-list-card:hover h2 { color: var(--gold); }

    .recipe-list-card p {
        font-size: 0.85rem;
        line-height: 1.75;
        color: #6b6055;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .recipe-list-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.68rem;
        letter-spacing: 0.1em;
        color: #9a8e84;
        border-top: 1px solid rgba(184,148,58,0.15);
        padding-top: 0.85rem;
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
                            <img
                                src="{{ $recipe->image ? asset('storage/' . $recipe->image) : asset('images/placeholder.jpg') }}"
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
