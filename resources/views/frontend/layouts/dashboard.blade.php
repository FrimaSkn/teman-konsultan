<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} | @yield('title')</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'Frimzz')">

    @yield('meta')

    <x-utils.favicon />

    @stack('before-styles')

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/frontend/dashboard.scss', 'resources/js/frontend/dashboard/app.js'])

        <livewire:styles />

        @stack('after-styles')
</head>

<body>
    {{-- @include('includes.partials.read-only') --}}
    {{-- @include('includes.partials.logged-in-as') --}}
    {{-- @include('includes.partials.announcements') --}}


    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>{{ appName() }}</h3>
                <strong>TK</strong>
            </div>

            <ul class="list-unstyled components">
                {{-- <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-taxi"></i>
                        Richiedi
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Home 1</a>
                        </li>
                        <li>
                            <a href="#">Home 2</a>
                        </li>
                    </ul>
                </li> --}}

                <li class="active">
                    <a href="#">
                        <i class="fas fa-book"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-sign-out-alt"></i>
                        Subcription
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-sign-out-alt"></i>
                        Transaksi
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="app">
            @include('frontend.includes.nav')
            {{-- @include('includes.partials.messages') --}}

            <main>
                @yield('content')
            </main>
        </div>
    </div>







    @stack('before-scripts')
    <livewire:scripts />
    @stack('after-scripts')
</body>

</html>
