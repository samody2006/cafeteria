@extends('layouts.app')

@section('title', 'Contact — God\'s Own Cafeteria')
@section('meta_description', 'Reach God\'s Own Cafeteria for bookings, events, and custom orders.')

@push('styles')
<style>
    .contact-hero {
        position: relative;
        min-height: 380px;
        display: grid;
        place-items: center;
        text-align: center;
        overflow: hidden;
    }
    .contact-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg, rgba(26,22,18,0.8), rgba(26,22,18,0.45)), url('{{ asset("images/about-hero.jpg") }}') center/cover;
        filter: saturate(0.85);
    }
    .contact-hero .content {
        position: relative;
        color: var(--cream);
        padding: 4rem 6vw;
        max-width: 720px;
    }
    .contact-hero h1 { font-size: clamp(2.6rem, 6vw, 4rem); margin-bottom: 0.6rem; }
    .contact-hero p { color: rgba(245,240,232,0.75); line-height: 1.8; }

    .contact-body { padding: 5rem 6vw; display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; }
    @media (max-width: 900px) { .contact-body { grid-template-columns: 1fr; } }

    .card {
        background: #fff;
        border: 1px solid rgba(184,148,58,0.2);
        padding: 2rem;
        box-shadow: 0 15px 40px rgba(0,0,0,0.04);
    }
    .card h3 { margin-bottom: 1rem; font-size: 1.4rem; }
    .card p { color: #5a5048; line-height: 1.8; }

    .contact-grid { display: grid; gap: 1rem; margin-top: 1.5rem; }
    .contact-item { display: flex; align-items: center; gap: 0.9rem; padding: 0.75rem 1rem; border: 1px solid rgba(184,148,58,0.25); }
    .contact-icon {
        width: 38px; height: 38px;
        display: grid; place-items: center;
        border-radius: 50%;
        background: rgba(184,148,58,0.14);
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
            <form class="form-grid" action="mailto:{{ optional($contact)->email ?? 'Eastheromoh@gmail.com' }}" method="post" enctype="text/plain">
                <div class="form-grid two">
                    <input class="input" type="text" name="name" placeholder="Your name" required>
                    <input class="input" type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-grid two">
                    <input class="input" type="text" name="phone" placeholder="Phone">
                    <input class="input" type="text" name="service" placeholder="Service needed (catering, cakes, events)">
                </div>
                <textarea class="input" name="message" placeholder="Tell us about your booking or order" required></textarea>
                <button class="btn-primary" type="submit">Send Email</button>
            </form>
        </div>
    </section>
@endsection
