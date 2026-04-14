@extends('layouts.app')

@section('title', 'Contact — God\'s Own Cafeteria')
@section('meta_description', 'Reach God\'s Own Cafeteria for bookings, events, and custom orders.')

@push('styles')
<style>
    .contact-hero {
        position: relative;
        min-height: 420px;
        display: grid;
        place-items: center;
        text-align: center;
        overflow: hidden;
    }

    .contact-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(26,22,18,0.92), rgba(26,22,18,0.55)), url('{{ asset("images/about-hero.jpg") }}') center/cover;
        filter: saturate(0.9);
        animation: heroFade 6s ease forwards;
    }

    @keyframes heroFade {
        from { opacity: 0.9; }
        to { opacity: 1; }
    }

    .contact-hero .content {
        position: relative;
        color: var(--cream);
        padding: 4rem 6vw;
        max-width: 720px;
        animation: fadeUp 1.2s 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        opacity: 0;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .contact-hero .eyebrow {
        font-size: 0.65rem;
        letter-spacing: 0.35em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 0.8rem;
        font-weight: 500;
    }

    .contact-hero h1 {
        font-size: clamp(2.5rem, 5vw, 4.2rem);
        margin-bottom: 0.8rem;
        font-weight: 400;
        line-height: 1.1;
    }

    .contact-hero p {
        color: rgba(245,240,232,0.8);
        line-height: 1.8;
        font-size: 1rem;
    }

    .contact-body {
        padding: 5rem 6vw;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3.5rem;
    }

    @media (max-width: 900px) {
        .contact-body { grid-template-columns: 1fr; }
    }

    .card {
        background: #fff;
        border: 1.5px solid rgba(184,148,58,0.2);
        padding: 2.5rem;
        box-shadow: 0 12px 32px rgba(0,0,0,0.05);
        border-radius: 4px;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .card:hover {
        border-color: rgba(184,148,58,0.5);
        box-shadow: 0 20px 48px rgba(0,0,0,0.08);
        transform: translateY(-4px);
    }

    .card h3 {
        margin-bottom: 1.2rem;
        font-size: 1.55rem;
        color: var(--ink);
        font-family: 'Cormorant Garamond', serif;
    }

    .card p {
        color: #6b6055;
        line-height: 1.8;
        font-size: 0.95rem;
    }

    .contact-grid {
        display: grid;
        gap: 1rem;
        margin-top: 1.8rem;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 0.9rem 1.2rem;
        border: 1.5px solid rgba(184,148,58,0.18);
        border-radius: 3px;
        transition: all 0.3s ease;
    }

    .contact-item:hover {
        border-color: var(--gold);
        background: rgba(184,148,58,0.04);
    }

    .contact-icon {
        width: 40px;
        height: 40px;
        display: grid;
        place-items: center;
        border-radius: 50%;
        background: rgba(184,148,58,0.18);
        flex-shrink: 0;
        color: var(--gold);
        font-size: 1.2rem;
    }

    .contact-item-text {
        flex: 1;
    }

    .contact-item-text a {
        color: var(--gold);
        text-decoration: none;
        transition: color 0.2s;
        font-weight: 500;
    }

    .contact-item-text a:hover { color: var(--rust); }

    /* ── Form Styles ─────────────────────────────────────────── */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.6rem;
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--ink);
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1.5px solid rgba(184,148,58,0.2);
        border-radius: 3px;
        font-family: inherit;
        font-size: 0.95rem;
        background: #fff;
        transition: all 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(184,148,58,0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }

    .submit-btn {
        width: 100%;
        padding: 1rem;
        background: var(--ink);
        color: var(--cream);
        border: none;
        font-size: 0.85rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        cursor: pointer;
        border-radius: 3px;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        font-weight: 600;
    }

    .submit-btn:hover {
        background: var(--gold);
        color: var(--ink);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(26,22,18,0.15);
    }

        color: var(--ink);
    }
    .contact-link { color: var(--ink); text-decoration: none; }
    .contact-link:hover { color: var(--gold); }

    .form-grid { display: grid; gap: 1rem; }
    .form-grid.two { grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; }
    .input { width: 100%; padding: 0.75rem 0.9rem; border: 1px solid rgba(26,22,18,0.15); background: #fff; }
    .input:focus { outline: 1px solid var(--gold); }
    textarea.input { min-height: 140px; resize: vertical; }
</style>
@endpush

@section('content')
    <section class="contact-hero">
        <div class="content">
            <p class="eyebrow" style="letter-spacing:0.25em;text-transform:uppercase;color:var(--gold);">✦ Contact</p>
            <h1>Plan an event, book catering, or just say hello.</h1>
            <p>We reply within one business day. Call for urgent catering and same‑day orders.</p>
        </div>
    </section>

    <section class="contact-body">
        <div class="card">
            <h3>Contact Details</h3>
            <p>Direct lines to the kitchen and events team.</p>

            <div class="contact-grid">
                <div class="contact-item">
                    <span class="contact-icon">📞</span>
                    <div>
                        <a class="contact-link" href="tel:{{ optional($contact)->phone_primary ?? '07083415288' }}">{{ optional($contact)->phone_primary ?? '07083415288' }}</a><br>
                        @if($contact?->phone_secondary)
                            <a class="contact-link" href="tel:{{ $contact->phone_secondary }}">{{ $contact->phone_secondary }}</a>
                        @else
                            <span class="contact-link">08052113225</span>
                        @endif
                    </div>
                </div>
                <div class="contact-item">
                    <span class="contact-icon">✉️</span>
                    <a class="contact-link" href="mailto:{{ optional($contact)->email ?? 'Eastheromoh@gmail.com' }}">{{ optional($contact)->email ?? 'Eastheromoh@gmail.com' }}</a>
                </div>
                @if($contact?->address)
                <div class="contact-item">
                    <span class="contact-icon">📍</span>
                    <span class="contact-link">{{ $contact->address }}</span>
                </div>
                @endif
                <div class="contact-item" style="gap:0.6rem;">
                    @if($contact?->instagram_url)
                        <a class="contact-icon" href="{{ $contact->instagram_url }}" aria-label="Instagram" target="_blank">IG</a>
                    @endif
                    @if($contact?->facebook_url)
                        <a class="contact-icon" href="{{ $contact->facebook_url }}" aria-label="Facebook" target="_blank">Fb</a>
                    @endif
                    @if($contact?->twitter_url)
                        <a class="contact-icon" href="{{ $contact->twitter_url }}" aria-label="Twitter" target="_blank">X</a>
                    @endif
                    @if(!($contact?->instagram_url || $contact?->facebook_url || $contact?->twitter_url))
                        <span class="text-sm text-gray-500">Add social links in dashboard → Contact</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="card">
            <h3>Send a Note</h3>
            <p>Share your event date, headcount, and any dietary preferences.</p>
            @if (session('success'))
                <div class="text-sm text-green-700 bg-green-50 border border-green-200 px-3 py-2 rounded mb-2">
                    {{ session('success') }}
                </div>
            @endif
            <form class="form-grid" action="{{ route('contact.messages.store') }}" method="POST">
                @csrf
                <div class="form-grid two">
                    <input class="input" type="text" name="name" placeholder="Your name" value="{{ old('name') }}" required>
                    <input class="input" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                </div>
                <div class="form-grid two">
                    <input class="input" type="text" name="phone" placeholder="Phone" value="{{ old('phone') }}">
                    <input class="input" type="text" name="service" placeholder="Service needed (catering, cakes, events)" value="{{ old('service') }}">
                </div>
                <textarea class="input" name="message" placeholder="Tell us about your booking or order" required>{{ old('message') }}</textarea>
                @if($errors->any())
                    <ul class="text-sm text-red-600 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <button class="btn-primary" type="submit">Send Email</button>
            </form>
        </div>
    </section>
@endsection
