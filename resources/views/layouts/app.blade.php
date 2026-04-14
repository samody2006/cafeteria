<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'God\'s Own Cafeteria'))</title>
    <meta name="description" content="@yield('meta_description', 'Artisanal recipes, culinary stories, and fine dining by God\'s Own Cafeteria.')">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">

    {{-- Tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --cream:  #f5f0e8;
            --ink:    #1a1612;
            --gold:   #b8943a;
            --rust:   #8b3a2a;
            --warm:   #e8dcc8;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            background-color: var(--cream);
            color: var(--ink);
            font-family: 'Jost', sans-serif;
            font-weight: 300;
            letter-spacing: 0.01em;
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Cormorant Garamond', serif;
            font-weight: 400;
        }

        .serif { font-family: 'Cormorant Garamond', serif; }

        /* Nav */
        .site-nav {
            position: fixed; top: 0; left: 0; right: 0;
            z-index: 100;
            background: rgba(245,240,232,0.92);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(184,148,58,0.2);
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.35rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--ink);
            text-decoration: none;
        }

        .nav-logo span { color: var(--gold); }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            list-style: none;
            margin: 0; padding: 0;
        }

        .nav-links a {
            font-size: 0.72rem;
            font-weight: 400;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--ink);
            text-decoration: none;
            transition: color 0.2s;
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -3px; left: 0; right: 0;
            height: 1px;
            background: var(--gold);
            transform: scaleX(0);
            transition: transform 0.25s ease;
        }

        .nav-links a:hover { color: var(--gold); }
        .nav-links a:hover::after { transform: scaleX(1); }
        .nav-links a.active { color: var(--gold); }
        .nav-links a.active::after { transform: scaleX(1); }

        /* Hamburger for mobile */
        .nav-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            background: none;
            border: none;
            padding: 4px;
        }
        .nav-toggle span {
            display: block;
            width: 24px; height: 1.5px;
            background: var(--ink);
            transition: all 0.3s;
        }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .nav-toggle { display: flex; }
            .nav-links.open {
                display: flex;
                flex-direction: column;
                position: fixed;
                top: 64px; left: 0; right: 0;
                background: var(--cream);
                padding: 2rem;
                gap: 1.5rem;
                border-bottom: 1px solid var(--warm);
            }
        }

        /* Page wrapper */
        .page-content { padding-top: 64px; }

        /* Utility */
        .gold-line {
            display: inline-block;
            width: 40px; height: 1px;
            background: var(--gold);
            vertical-align: middle;
            margin: 0 0.75rem;
        }

        .btn-primary {
            display: inline-block;
            padding: 0.6rem 2rem;
            border: 1px solid var(--ink);
            font-size: 0.7rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--ink);
            text-decoration: none;
            background: transparent;
            cursor: pointer;
            transition: background 0.25s, color 0.25s;
        }
        .btn-primary:hover {
            background: var(--ink);
            color: var(--cream);
        }

        .btn-gold {
            display: inline-block;
            padding: 0.6rem 2rem;
            background: var(--gold);
            border: 1px solid var(--gold);
            font-size: 0.7rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.25s;
        }
        .btn-gold:hover { background: #9a7b2e; border-color: #9a7b2e; }

        /* Footer */
        .site-footer {
            background: var(--ink);
            color: var(--warm);
            padding: 4rem 2rem 2rem;
            text-align: center;
        }
        .site-footer .footer-logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            color: var(--gold);
            margin-bottom: 1.5rem;
        }
        .site-footer nav a {
            color: var(--warm);
            text-decoration: none;
            font-size: 0.7rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            margin: 0 1rem;
            opacity: 0.7;
            transition: opacity 0.2s;
        }
        .site-footer nav a:hover { opacity: 1; }
        .site-footer .copyright {
            margin-top: 3rem;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            opacity: 0.4;
        }
        .footer-divider {
            width: 60px; height: 1px;
            background: var(--gold);
            margin: 1.5rem auto;
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Navigation --}}
    <header class="site-nav">
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto transition-transform group-hover:scale-105">
            <span class="nav-logo hidden sm:inline-block">God's Own <span>Cafeteria</span></span>
        </a>

        <ul class="nav-links" id="navLinks">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('recipes.index') }}" class="{{ request()->routeIs('recipes.*') ? 'active' : '' }}">Recipes</a></li>
            <li><a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
            <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
        </ul>

        <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>
    </header>

    {{-- Flash Messages --}}
    @if (session('success'))
        <div style="position:fixed;bottom:2rem;right:2rem;z-index:999;background:var(--gold);color:#fff;padding:0.75rem 1.5rem;font-size:0.8rem;letter-spacing:0.1em;">
            {{ session('success') }}
        </div>
    @endif

    <main class="page-content">
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="flex flex-col items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 w-auto mb-4 brightness-0 invert opacity-80">
            <div class="footer-logo">God's Own Cafeteria</div>
        </div>
        <div class="footer-divider"></div>
        <nav>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('recipes.index') }}">Recipes</a>
            <a href="{{ route('gallery') }}">Gallery</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('contact') }}">Contact</a>
        </nav>
        <p class="copyright">&copy; {{ date('Y') }} God's Own Cafeteria. All rights reserved.</p>
    </footer>

    <script>
        const toggle = document.getElementById('navToggle');
        const links  = document.getElementById('navLinks');
        toggle?.addEventListener('click', () => links.classList.toggle('open'));

        // Flash dismiss
        setTimeout(() => {
            document.querySelectorAll('[style*="position:fixed;bottom"]').forEach(el => {
                el.style.transition = 'opacity 0.5s';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 500);
            });
        }, 3500);
    </script>

    @stack('scripts')
</body>
</html>
