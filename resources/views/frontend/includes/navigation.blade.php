<header>
    <nav>
        <a href="{{ url('/') }}" class="logo">
            <img class="h-12 md:h-20" src="{{ asset('img/brand/logo.png') }}" alt="">
        </a>

        {{-- menu desktop --}}
        <div class="menu">
            <div class="flex gap-4">
                <div class="flex items-center gap-2">
                    <a rel="alternate" hreflang="en" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}" class="text-sm {{ LaravelLocalization::getCurrentLocale() == 'en' ? 'px-2 py-px uppercase bg-primary rounded-md font-medium text-white':''}}">ENG</a>
                    <div class="w-px h-4 bg-black"></div>
                    <a rel="alternate" hreflang="id" href="{{ LaravelLocalization::getLocalizedURL('id', null, [], true) }}" class="text-sm {{ LaravelLocalization::getCurrentLocale() == 'id' ? 'px-2 py-px uppercase bg-primary rounded-md font-medium text-white':''}}">IDN</a>
                </div>
                <a href="{{ route('frontend.auth.free-consultation.index') }}"
                    class="px-4 py-2 text-sm font-medium leading-none uppercase rounded-lg hover:bg-opacity-90 text-nowrap
                            {{ Route::is('frontend.auth.free-consultation.*') || Route::is('frontend.auth.free-consultation.index') ? 'bg-secondary text-primary' : 'bg-primary text-secondary' }}"
                >free consultation</a>
                @guest
                    <a href="{{ route('frontend.auth.login') }}"
                        class="px-4 py-2 text-sm font-medium leading-none uppercase rounded-lg hover:bg-opacity-90 text-nowrap
                        {{ Route::is('frontend.auth.*') || Route::is('frontend.auth.login') ? 'bg-secondary text-primary' : 'bg-primary text-secondary' }}"
                    >login</a>
                @else
                    <div class="relative flex gap-2" x-data="{ open: false }" x-on:click.away="open = false">
                        <button x-on:click="open = !open" class="flex items-center gap-3">
                            <span class="text-sm font-semibold truncate max-w-20">{{ $logged_in_user->name }}</span>
                            <img class="rounded-full size-8 bg-slate-200" src="{{ $logged_in_user->avatar }}" />
                        </button>
                        <div class="absolute right-0 z-50 overflow-hidden bg-white rounded shadow top-12 min-w-40" x-show="open" x-cloak>
                            <div class="px-4 py-2 bg-gray-100 text-nowrap">
                                <div class="font-semibold">{{ $logged_in_user->name }}</div>
                            </div>
                            <div class="px-4 py-2 divide-y">
                                <div class="py-2">
                                    <a href="{{ route('frontend.user.account') }}" class="flex items-center gap-1 cursor-pointer hover:text-primary">
                                        <i class="size-4" data-lucide="user-round"></i>
                                        @lang('My Account')
                                    </a>
                                </div>
                                <div class="flex items-center gap-1 py-2 cursor-pointer hover:text-primary" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="size-4" data-lucide="log-out"></i>
                                    @lang('Logout')
                                    <x-forms.post :action="route('frontend.auth.logout')" id="logout-form" class="d-none" />
                                </div>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>
            <ul class="menu-list">
                <li>
                    <a href="{{ route('frontend.home') }}" class="menu-item {{ activeMenu('frontend.home') }}">@lang('Home')</a>
                </li>
                <li>
                    <div x-data="{ open: false }" x-on:click.away="open = false">
                        <button x-on:click="open = !open" class="menu-item">@lang('Our Services')</button>
                        <div
                            x-show="open"
                            class="absolute inset-x-0 bg-white top-[7.4rem] shadow"
                            x-transition:enter="transition ease-in duration-100"
                            x-transition:enter-start="opacity-0 -translate-x-2"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition ease-out duration-100"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 -translate-x-2"
                            x-cloak
                            >
                            <div class="tabs-container" x-data="{ tab: '{{ $services->first()->slug }}' }">
                                <div class="tabs-menu">
                                    <div class="mb-2 ml-4 font-medium uppercase text-primary">@lang('Our Services')</div>
                                    <ul class="tab-item">
                                        @foreach ($services as $category)
                                            <li x-on:click.prevent="tab = '{{ $category->slug }}'" x-bind:class="{ 'active': tab === '{{ $category->slug }}' }" class="text-gray-700 cursor-pointer text-nowrap">
                                                <span>{{ $category->name }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="grid grid-flow-col grid-rows-5 p-6 grid-cols-auto gap-x-8 tabs-content">
                                    @foreach ($services as $category)
                                        @foreach ($category->services as $service)
                                            <div x-show="tab === '{{ $category['slug'] }}'" class="p-1 cursor-pointer hover:bg-gray-100">
                                                <div class="leading-none">
                                                    <h2 class="font-semibold">{{ $service['name'] }}</h2>
                                                    <p class="text-sm text-gray-600">{{ $service['description'] }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="{{ route('frontend.harga') }}" class="menu-item {{ activeMenu('frontend.harga') }}">@lang('Pricing')</a>
                </li>
                <li>
                    <a href="{{ route('frontend.post.index') }}" class="menu-item {{ activeMenu('frontend.post.*') }}">@lang('Articles')</a>
                </li>
                <li>
                    <a href="{{ route('frontend.about') }}" class="menu-item {{ activeMenu('frontend.about') }}">@lang('About Us')</a>
                </li>
                <li>
                    <a href="{{ route('frontend.contact-us') }}" class="menu-item {{ activeMenu('frontend.contact-us') }}">@lang('Contact Us')</a>
                </li>
            </ul>
        </div>

        <div x-data="menuToggle" class="flex items-center gap-2 lg:hidden">
            <div class="flex items-center gap-2">
                <a rel="alternate" hreflang="en" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}" class="text-xs {{ LaravelLocalization::getCurrentLocale() == 'en' ? 'px-2 py-px uppercase bg-primary rounded-md font-medium text-white':''}}">ENG</a>
                <div class="w-px h-4 bg-black"></div>
                <a rel="alternate" hreflang="id" href="{{ LaravelLocalization::getLocalizedURL('id', null, [], true) }}" class="text-xs {{ LaravelLocalization::getCurrentLocale() == 'id' ? 'px-2 py-px uppercase bg-primary rounded-md font-medium text-white':''}}">IDN</a>
            </div>

            <div id="nav-icon3" x-bind:class="{ 'open': open }" x-on:click="toggleOpen()">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <template x-teleport="body">
                <div class="fixed inset-x-0 bottom-0 w-full h-screen bg-white top-14 z-[99] pt-10 md:pt-20" x-show="open"
                    x-transition:enter="transition ease-in duration-200"
                    x-transition:enter-start="-translate-y-[100%]"
                    x-transition:enter-end="translate-y-0"
                    x-transition:leave="transition ease-out duration-200"
                    x-transition:leave-start="translate-y-0"
                    x-transition:leave-end="-translate-y-[100%]"
                >
                    <ul class="container mx-auto *:text-center divide-y-2 divide-amber-100 *:py-3">
                        <li><a href="{{ route('frontend.home') }}" class="menu-item {{ activeMenu('frontend.home') }}">@lang('Home')</a></li>
                        <li>
                            <a href="#" class="flex items-center justify-center gap-1 menu-item">@lang('Our Services') <i data-lucide="chevron-right" class="size-4"></i></a>
                        </li>
                        <li><a href="{{ route('frontend.harga') }}" class="menu-item {{ activeMenu('frontend.harga') }}">@lang('Pricing')</a></li>
                        <li><a href="{{ route('frontend.post.index') }}" class="menu-item {{ activeMenu('frontend.post.index') }}">@lang('Articles')</a></li>
                        <li><a href="{{ route('frontend.about') }}" class="menu-item {{ activeMenu('frontend.about') }}">@lang('About Us')</a></li>
                        <li><a href="{{ route('frontend.contact-us') }}" class="menu-item {{ activeMenu('frontend.contact-us') }}">@lang('Contact Us')</a></li>
                    </ul>

                    <div class="container flex flex-col items-center gap-2 mt-4">
                        @guest
                            <a href="{{ route('frontend.auth.login') }}"
                                class="px-3 py-1.5 text-xs font-medium leading-none uppercase rounded-lg hover:bg-opacity-90 text-nowrap
                                {{ Route::is('frontend.auth.*') || Route::is('frontend.auth.login') ? 'bg-secondary text-primary' : 'bg-primary text-secondary' }}"
                            >login</a>
                        @else
                            <div class="relative flex gap-2" x-data="{ open: false }" x-on:click.away="open = false">
                                <button x-on:click="open = !open" class="flex items-center gap-3">
                                    <img class="rounded-full size-7 bg-slate-200" src="{{ $logged_in_user->avatar }}" />
                                    <span class="text-xs font-semibold truncate max-w-20">{{ $logged_in_user->name }}</span>
                                </button>
                                <div class="absolute z-50 overflow-hidden bg-white rounded shadow top-12 min-w-40" x-show="open" x-cloak>
                                    <div class="px-4 py-2 bg-gray-100 text-nowrap">
                                        <div class="font-semibold">{{ $logged_in_user->name }}</div>
                                    </div>
                                    <div class="px-4 py-2 divide-y">
                                        <div class="py-2">
                                            <a href="{{ route('frontend.user.account') }}" class="flex items-center gap-1 cursor-pointer hover:text-primary">
                                                <i class="size-4" data-lucide="user-round"></i>
                                                @lang('My Account')
                                            </a>
                                        </div>
                                        <div class="flex items-center gap-1 py-2 cursor-pointer hover:text-primary" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            <i class="size-4" data-lucide="log-out"></i>
                                            @lang('Logout')
                                            <x-forms.post :action="route('frontend.auth.logout')" id="logout-form" class="d-none" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('frontend.auth.free-consultation.index') }}"
                                    class="px-3 py-1.5 text-xs font-medium leading-none uppercase rounded-lg hover:bg-opacity-90 text-nowrap
                                    {{ Route::is('frontend.auth.free-consultation.*') || Route::is('frontend.auth.free-consultation.index') ? 'bg-secondary text-primary' : 'bg-primary text-secondary' }}"
                                >free consultation
                            </a>
                        @endguest

                    </div>
                </div>
            </template>
        </div>
    </nav>
</header>

@push('after-scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('menuToggle', () => ({
                open: false,
                toggleOpen() {
                    this.open = !this.open

                    icons()
                },
            }))
        });

    </script>
@endpush
