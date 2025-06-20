<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} | @yield('title')</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
    @yield('meta')

    @stack('before-styles')
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/frontend/app.scss', 'resources/js/frontend/app.js'])

    @livewireStyles

    @stack('after-styles')
</head>
<body>
    @include('includes.partials.read-only')
    @include('includes.partials.logged-in-as')

    <div id="app">
        @include('frontend.includes.navigation')
        {{-- @include('includes.partials.messages') --}}

        <main>
            @yield('content')
        </main>
    </div><!--app-->

    @include('frontend.includes.footer')

    @vite('resources/js/frontend/plugins.js')

    @stack('before-scripts')
    @livewireScripts
    @stack('after-scripts')
</body>
</html>
