<title>{{ $seo['title'] }}</title>
<meta name="description" content="{{ $seo['description'] }}">

@if ($seo['canonical'])
    <link rel="canonical" href="{{ $seo['canonical'] }}">
@endif

<meta name="robots" content="{{ $seo['robots'] }}">

@if ($seo['author'])
    <meta name="author" content="{{ $seo['author'] }}">
@endif

@foreach ($seo['alternates'] as $hreflang => $url)
    <link rel="alternate" hreflang="{{ $hreflang }}" href="{{ $url }}">
@endforeach

<meta property="og:site_name" content="{{ $seo['siteName'] }}">
<meta property="og:type" content="{{ $seo['type'] }}">
<meta property="og:title" content="{{ $seo['pageTitle'] }}">
<meta property="og:description" content="{{ $seo['description'] }}">
<meta property="og:url" content="{{ $seo['canonical'] }}">
<meta property="og:locale" content="{{ $seo['ogLocale'] }}">

@if ($seo['image'])
    <meta property="og:image" content="{{ $seo['image'] }}">
    <meta property="og:image:alt" content="{{ $seo['pageTitle'] }}">
@endif

@foreach ($seo['alternates'] as $hreflang => $url)
    @continue($hreflang === 'x-default' || $hreflang === $seo['locale'])
    <meta property="og:locale:alternate" content="{{ $hreflang === 'id' ? 'id_ID' : ($hreflang === 'en' ? 'en_US' : str_replace('-', '_', $hreflang)) }}">
@endforeach

@if ($seo['type'] === 'article')
    @if ($seo['publishedTime'])
        <meta property="article:published_time" content="{{ $seo['publishedTime'] }}">
    @endif
    @if ($seo['modifiedTime'])
        <meta property="article:modified_time" content="{{ $seo['modifiedTime'] }}">
    @endif
    @if ($seo['author'])
        <meta property="article:author" content="{{ $seo['author'] }}">
    @endif
@endif

<meta name="twitter:card" content="{{ $seo['image'] ? 'summary_large_image' : 'summary' }}">
@if ($seo['twitterSite'])
    <meta name="twitter:site" content="{{ $seo['twitterSite'] }}">
@endif
<meta name="twitter:title" content="{{ $seo['pageTitle'] }}">
<meta name="twitter:description" content="{{ $seo['description'] }}">
@if ($seo['image'])
    <meta name="twitter:image" content="{{ $seo['image'] }}">
@endif

@if ($seo['googleSiteVerification'])
    <meta name="google-site-verification" content="{{ $seo['googleSiteVerification'] }}">
@endif

@if ($seo['bingSiteVerification'])
    <meta name="msvalidate.01" content="{{ $seo['bingSiteVerification'] }}">
@endif

<script type="application/ld+json">{!! json_encode($seo['jsonLd'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>

@if ($seo['analyticsId'])
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $seo['analyticsId'] }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', '{{ $seo['analyticsId'] }}');
    </script>
@endif
