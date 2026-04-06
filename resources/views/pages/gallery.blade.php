@extends('layouts.app')

@section('title', 'Gallery — Chef & Table')
@section('meta_description', 'Behind-the-scenes photography from culinary events, dinners, and the kitchen.')

@push('styles')
<style>
    /* ── Gallery Hero ─────────────────────────────────────────── */
    .gallery-hero {
        padding: 6rem 6vw 3rem;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 2rem;
        flex-wrap: wrap;
        border-bottom: 1px solid rgba(184,148,58,0.15);
    }

    .gallery-hero .eyebrow {
        font-size: 0.65rem;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 0.5rem;
    }

    .gallery-hero h1 {
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        line-height: 1;
    }

    .gallery-hero h1 em { font-style: italic; }

    .gallery-hero p {
        max-width: 360px;
        font-size: 0.88rem;
        line-height: 1.8;
        color: #6b6055;
    }

    /* ── Masonry Grid ─────────────────────────────────────────── */
    .gallery-section {
        padding: 4rem 6vw 6rem;
    }

    .masonry-grid {
        columns: 3;
        column-gap: 3px;
    }

    @media (max-width: 900px) { .masonry-grid { columns: 2; } }
    @media (max-width: 500px) { .masonry-grid { columns: 1; } }

    .masonry-item {
        break-inside: avoid;
        margin-bottom: 3px;
        position: relative;
        overflow: hidden;
        cursor: pointer;
        display: block;
    }

    .masonry-item img {
        width: 100%;
        display: block;
        transition: transform 0.6s ease;
        filter: saturate(0.85);
    }

    .masonry-item:hover img {
        transform: scale(1.04);
        filter: saturate(1.1);
    }

    .masonry-overlay {
        position: absolute;
        inset: 0;
        background: rgba(26,22,18,0);
        transition: background 0.4s;
        display: flex;
        align-items: flex-end;
        padding: 1.5rem;
    }

    .masonry-item:hover .masonry-overlay {
        background: rgba(26,22,18,0.45);
    }

    .masonry-caption {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.1rem;
        font-style: italic;
        color: var(--cream);
        opacity: 0;
        transform: translateY(8px);
        transition: opacity 0.3s 0.05s, transform 0.3s 0.05s;
    }

    .masonry-item:hover .masonry-caption {
        opacity: 1;
        transform: translateY(0);
    }

    /* ── Lightbox ─────────────────────────────────────────────── */
    .lightbox {
        position: fixed;
        inset: 0;
        z-index: 1000;
        background: rgba(26,22,18,0.97);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s;
    }

    .lightbox.open {
        opacity: 1;
        pointer-events: all;
    }

    .lightbox-inner {
        position: relative;
        max-width: 90vw;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .lightbox-img {
        max-width: 100%;
        max-height: 80vh;
        object-fit: contain;
        display: block;
    }

    .lightbox-caption {
        margin-top: 1.5rem;
        font-family: 'Cormorant Garamond', serif;
        font-style: italic;
        color: rgba(245,240,232,0.6);
        font-size: 1rem;
        text-align: center;
    }

    .lightbox-close {
        position: absolute;
        top: -3.5rem;
        right: 0;
        background: none;
        border: none;
        color: rgba(245,240,232,0.6);
        font-size: 1.5rem;
        cursor: pointer;
        letter-spacing: 0.1em;
        font-family: 'Jost', sans-serif;
        font-weight: 300;
        transition: color 0.2s;
    }

    .lightbox-close:hover { color: var(--gold); }

    .lightbox-nav {
        position: fixed;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: 1px solid rgba(245,240,232,0.2);
        color: rgba(245,240,232,0.6);
        width: 48px; height: 48px;
        font-size: 1.3rem;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .lightbox-nav:hover {
        background: rgba(245,240,232,0.1);
        color: var(--gold);
        border-color: var(--gold);
    }

    .lightbox-nav.prev { left: 2rem; }
    .lightbox-nav.next { right: 2rem; }

    /* ── Empty state ─────────────────────────────────────────── */
    .gallery-empty {
        text-align: center;
        padding: 6rem 0;
        color: #9a8e84;
    }

    .gallery-empty h3 {
        font-size: 2rem;
        color: var(--gold);
        margin-bottom: 0.75rem;
    }
</style>
@endpush

@section('content')

    {{-- ── Page Hero ─────────────────────────────────────────────── --}}
    <div class="gallery-hero">
        <div>
            <p class="eyebrow">✦ Chef & Table</p>
            <h1>The <em>Gallery</em></h1>
        </div>
        <p>
            Snapshots from private dinners, pop-up events, culinary travels,
            and the quiet ritual of daily mise en place.
        </p>
    </div>

    {{-- ── Masonry ──────────────────────────────────────────────── --}}
    <div class="gallery-section">
        @if($images && $images->count())
            <div class="masonry-grid" id="masonryGrid">
                @foreach($images as $img)
                    <div
                        class="masonry-item"
                        data-src="{{ asset('storage/' . $img->image_path) }}"
                        data-caption="{{ $img->caption ?? '' }}"
                        data-index="{{ $loop->index }}"
                        onclick="openLightbox({{ $loop->index }})"
                    >
                        <img
                            src="{{ asset('storage/' . $img->image_path) }}"
                            alt="{{ $img->caption ?? 'Gallery image' }}"
                            loading="lazy"
                        >
                        <div class="masonry-overlay">
                            @if($img->caption)
                                <p class="masonry-caption">{{ $img->caption }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="gallery-empty">
                <h3>Gallery Coming Soon</h3>
                <p>New photographs from the kitchen and table will appear here shortly.</p>
            </div>
        @endif
    </div>

    {{-- ── Lightbox ──────────────────────────────────────────────── --}}
    <div class="lightbox" id="lightbox">
        <button class="lightbox-nav prev" id="lbPrev">‹</button>
        <button class="lightbox-nav next" id="lbNext">›</button>
        <div class="lightbox-inner">
            <button class="lightbox-close" id="lbClose">✕ Close</button>
            <img src="" alt="" class="lightbox-img" id="lbImg">
            <p class="lightbox-caption" id="lbCaption"></p>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    const items = Array.from(document.querySelectorAll('.masonry-item'));
    const lightbox = document.getElementById('lightbox');
    const lbImg    = document.getElementById('lbImg');
    const lbCaption = document.getElementById('lbCaption');
    let current = 0;

    function openLightbox(index) {
        current = index;
        updateLightbox();
        lightbox.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function updateLightbox() {
        const item = items[current];
        lbImg.src = item.dataset.src;
        lbImg.alt = item.dataset.caption || '';
        lbCaption.textContent = item.dataset.caption || '';
    }

    document.getElementById('lbClose').addEventListener('click', () => {
        lightbox.classList.remove('open');
        document.body.style.overflow = '';
    });

    document.getElementById('lbPrev').addEventListener('click', () => {
        current = (current - 1 + items.length) % items.length;
        updateLightbox();
    });

    document.getElementById('lbNext').addEventListener('click', () => {
        current = (current + 1) % items.length;
        updateLightbox();
    });

    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) {
            lightbox.classList.remove('open');
            document.body.style.overflow = '';
        }
    });

    document.addEventListener('keydown', (e) => {
        if (!lightbox.classList.contains('open')) return;
        if (e.key === 'Escape') { lightbox.classList.remove('open'); document.body.style.overflow = ''; }
        if (e.key === 'ArrowLeft') { current = (current - 1 + items.length) % items.length; updateLightbox(); }
        if (e.key === 'ArrowRight') { current = (current + 1) % items.length; updateLightbox(); }
    });
</script>
@endpush
