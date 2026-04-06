@extends('layouts.app')

@section('title', 'Admin — Manage Recipes')

@push('styles')
<style>
    .admin-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        padding: 4rem 2rem 6rem;
    }

    .admin-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 3rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(184,148,58,0.2);
        flex-wrap: wrap;
        gap: 1rem;
    }

    .admin-header h1 { font-size: 2.5rem; }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    .admin-table thead tr {
        border-bottom: 1px solid var(--ink);
    }

    .admin-table th {
        text-align: left;
        padding: 0.75rem 1rem;
        font-size: 0.65rem;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: var(--gold);
        font-weight: 400;
    }

    .admin-table td {
        padding: 1rem 1rem;
        font-size: 0.88rem;
        border-bottom: 1px solid rgba(26,22,18,0.07);
        vertical-align: middle;
    }

    .admin-table tbody tr:hover td {
        background: rgba(184,148,58,0.04);
    }

    .admin-table .recipe-thumb {
        width: 60px; height: 44px;
        object-fit: cover;
        display: block;
        flex-shrink: 0;
    }

    .admin-table .title-cell {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .admin-table .recipe-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.1rem;
    }

    .action-links {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .action-links a {
        font-size: 0.68rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--ink);
        text-decoration: none;
        border-bottom: 1px solid transparent;
        transition: border-color 0.2s, color 0.2s;
        padding-bottom: 1px;
    }

    .action-links a:hover { border-color: var(--gold); color: var(--gold); }

    .action-links .delete-btn {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 0.68rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--rust);
        font-family: 'Jost', sans-serif;
        font-weight: 300;
        padding: 0;
        border-bottom: 1px solid transparent;
        transition: border-color 0.2s;
    }

    .action-links .delete-btn:hover { border-color: var(--rust); }

    .admin-table .empty-row td {
        text-align: center;
        padding: 4rem;
        color: #9a8e84;
        font-style: italic;
    }

    @media (max-width: 640px) {
        .admin-table thead { display: none; }
        .admin-table tr { display: block; padding: 1rem 0; border-bottom: 1px solid rgba(26,22,18,0.1); }
        .admin-table td { display: block; padding: 0.3rem 0; border: none; }
        .admin-table .title-cell { flex-direction: column; align-items: flex-start; }
    }
</style>
@endpush

@section('content')

    <div class="admin-wrapper">
        <div class="admin-header">
            <div>
                <p style="font-size:0.65rem;letter-spacing:0.28em;text-transform:uppercase;color:var(--gold);margin-bottom:0.3rem;">✦ Admin Panel</p>
                <h1>Recipes</h1>
            </div>
            <a href="{{ route('admin.recipes.create') }}" class="btn-gold">+ New Recipe</a>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width:50%;">Title</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recipes as $recipe)
                    <tr>
                        <td>
                            <div class="title-cell">
                                @if($recipe->image)
                                    <img
                                        src="{{ asset('storage/' . $recipe->image) }}"
                                        alt="{{ $recipe->title }}"
                                        class="recipe-thumb"
                                    >
                                @endif
                                <span class="recipe-title">{{ $recipe->title }}</span>
                            </div>
                        </td>
                        <td style="color:#9a8e84;font-size:0.82rem;">{{ $recipe->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="action-links">
                                <a href="{{ route('recipes.show', $recipe->slug) }}" target="_blank">View</a>
                                <a href="{{ route('admin.recipes.edit', $recipe->id) }}">Edit</a>
                                <form action="{{ route('admin.recipes.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('Delete this recipe permanently?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="empty-row">
                        <td colspan="3">No recipes yet. <a href="{{ route('admin.recipes.create') }}" style="color:var(--gold);">Create the first one →</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($recipes->hasPages())
            <div style="margin-top:3rem;display:flex;gap:0.5rem;justify-content:flex-end;">
                @if($recipes->onFirstPage())
                    <span class="btn-primary" style="opacity:0.3;cursor:default;">‹</span>
                @else
                    <a href="{{ $recipes->previousPageUrl() }}" class="btn-primary">‹</a>
                @endif

                @foreach($recipes->getUrlRange(1, $recipes->lastPage()) as $page => $url)
                    @if($page == $recipes->currentPage())
                        <span class="btn-primary" style="background:var(--ink);color:var(--cream);">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="btn-primary">{{ $page }}</a>
                    @endif
                @endforeach

                @if($recipes->hasMorePages())
                    <a href="{{ $recipes->nextPageUrl() }}" class="btn-primary">›</a>
                @else
                    <span class="btn-primary" style="opacity:0.3;cursor:default;">›</span>
                @endif
            </div>
        @endif
    </div>

@endsection
