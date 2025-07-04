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

    <div class="fixed z-50 bottom-2 right-2">
        <a href="https://wa.me/628123456789" target="_blank">
            {{-- <img class="transition-all w-72 hover:animate-pulse hover:scale-110" src="{{ asset('img/icons/floating-wa.png') }}" alt=""> --}}
            <div x-data="{ open: false }" x-on:mouseenter="open = true" x-on:mouseleave="open = false" class="relative flex items-center transition-all hover:animate-pulse hover:scale-110">
                <div x-show="open" x-cloak
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-x-10"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-x-0"
                    x-transition:leave-end="opacity-0 translate-x-10"
                    class="py-1 pl-2 pr-4 -mr-3 text-sm font-bold bg-gray-200 rounded shadow-2xl">Need help? Chat with us</div>
                <img class="relative z-10 w-16" src="{{ asset('img/icons/floating-icon-wa.png') }}" alt="">
            </div>
        </a>
    </div>

    @include('frontend.includes.footer')

    @vite('resources/js/frontend/plugins.js')

    @stack('before-scripts')
    @livewireScripts
    @stack('after-scripts')
</body>
</html>
