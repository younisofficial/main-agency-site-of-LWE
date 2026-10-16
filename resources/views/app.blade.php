<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $meta['title'] }}</title>
    <meta name="description" content="{{ $meta['description'] }}">
    <meta name="robots" content="{{ $noindex ? 'noindex, follow' : 'index, follow, max-image-preview:large, max-snippet:-1' }}">
    <link rel="canonical" href="{{ $canonical }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $agency['name'] }}">
    <meta property="og:locale" content="en_US">
    <meta property="og:title" content="{{ $meta['title'] }}">
    <meta property="og:description" content="{{ $meta['description'] }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $agency['name'] }} — {{ $agency['tagline'] }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $meta['title'] }}">
    <meta name="twitter:description" content="{{ $meta['description'] }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    <meta name="theme-color" content="#0e9f6e">
    <meta name="geo.region" content="PK-PB">
    <meta name="geo.placename" content="{{ $agency['city'] ?? 'Multan' }}">
    <meta name="format-detection" content="telephone=yes">
@if ($path === '/')
    <link rel="preload" as="image" href="{{ $agency['hero_photo'] }}" fetchpriority="high">
@endif
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">

    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=noto-sans:400,500,600,700|plus-jakarta-sans:700,800&display=swap" rel="stylesheet">

@foreach ($schemas as $schema)
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
@endforeach
    <script>window.__APP__ = {!! json_encode($bootstrap, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!};</script>

    {{-- Hide the plain text version while the design loads (it shows again only if the design fails to load). --}}
    <script>document.documentElement.classList.add('js');</script>
    <style>.js .seo-fallback{visibility:hidden;animation:show-fallback 0s 5s forwards}@keyframes show-fallback{to{visibility:visible}}</style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        {{-- Plain HTML for Google. Hidden while the design loads; Vue replaces it. --}}
        <div class="seo-fallback">
        <header>
            <a href="/">{{ $agency['name'] }}</a>
            <nav aria-label="Main">
                <a href="/services">Services</a>
                <a href="/pricing">Prices</a>
                <a href="/solutions">Solutions</a>
                <a href="/portfolio">Our work</a>
                <a href="/about">About us</a>
                <a href="/contact">Contact</a>
            </nav>
        </header>
        <main>
            <h1>{{ $meta['heading'] }}</h1>
            <p>{{ $meta['description'] }}</p>
            <h2>Our services</h2>
            <ul>
@foreach ($services as $service)
                <li><a href="/services/{{ $service->slug }}">{{ $service->title }}</a> — {{ $service->summary }}</li>
@endforeach
            </ul>
@if ($plans->isNotEmpty())
            <h2>Website prices in Pakistan (PKR)</h2>
@foreach ($plans->groupBy('category') as $category => $group)
            <ul>
@foreach ($group as $plan)
                <li>{{ ucfirst($category) }} – {{ $plan->name }}: Rs {{ number_format($plan->price) }}@if ($plan->price_max) – {{ number_format($plan->price_max) }}@endif. {{ $plan->best_for }}.</li>
@endforeach
            </ul>
@endforeach
@endif
@if ($path === '/solutions')
@foreach ($agency['solutions'] ?? [] as $item)
            <h2>{{ $item['title'] }}</h2>
            <p>{{ $item['problem'] }}</p>
            <p>Problems: {{ implode('. ', $item['problems']) }}.</p>
            <p>Our solution: {{ implode('. ', $item['solutions']) }}.</p>
            <p>Price: {{ $item['price'] }} ({{ $item['package'] }} package). {{ $item['math'] }}</p>
@endforeach
@endif
@if ($projects->isNotEmpty())
            <h2>Our work</h2>
            <ul>
@foreach ($projects as $project)
                <li>{{ $project->title }}@if ($project->client) ({{ $project->client }})@endif — {{ $project->summary }}</li>
@endforeach
            </ul>
@endif
            <p>{{ $agency['name'] }}, {{ $agency['address'] }}. Call or WhatsApp: <a href="tel:+{{ $agency['whatsapp'] }}">{{ $agency['phone'] }}</a></p>
        </main>
        </div>
    </div>
</body>
</html>
