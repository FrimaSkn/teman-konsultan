<header>
    <nav>
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('img/brand/logo.png') }}" alt="">
        </a>
        <div class="menu">
            <ul class="menu-list">
                <li>
                    <a href="{{ route('frontend.home') }}" class="menu-item {{ activeMenu('frontend.home') }}">Home</a>
                </li>
                <li>
                    <div x-data="{ open: false }" x-on:click.away="open = false">
                        <button x-on:click="open = !open" class="menu-item">Jasa Kami</button>
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
                            @php
                                $services = collect(config('web-data.services'));
                                $tab = $services->first();
                            @endphp
                            <div class="tabs-container" x-data="{ tab: '{{ $tab['slug'] }}' }">
                                <div class="tabs-menu">
                                    <div class="mb-2 ml-4 font-medium uppercase text-primary">Jasa Kami</div>
                                    <ul class="tab-item">
                                        @foreach ($services as $tabItem)
                                            <li x-on:click.prevent="tab = '{{ $tabItem['slug'] }}'" x-bind:class="{ 'active': tab === '{{ $tabItem['slug'] }}' }" class="text-gray-700 cursor-pointer">
                                                <span>{{ $tabItem['title'] }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="grid grid-flow-col grid-rows-5 p-6 grid-cols-auto gap-y-4 gap-x-10 tabs-content">
                                    @foreach ($services as $tabContent)
                                        @foreach ($tabContent['sub_menu'] as $content)
                                            <div x-show="tab === '{{ $tabContent['slug'] }}'" class="p-2 cursor-pointer hover:bg-gray-100">
                                                <div class="leading-none">
                                                    <h2 class="font-semibold">{{ $content['title'] }}</h2>
                                                    <p class="text-sm text-gray-600">{{ $content['desc'] }}</p>
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
                    <a href="{{ route('frontend.harga') }}" class="menu-item {{ activeMenu('frontend.harga') }}">Harga</a>
                </li>
                <li>
                    <a href="#" class="menu-item">Artikel</a>
                </li>
                <li>
                    <a href="#" class="menu-item">Tentang Kami</a>
                </li>
                <li>
                    <a href="#" class="menu-item">Hubungi Kami</a>
                </li>
            </ul>
            <div>
                <a href="#" class="px-4 pt-1 pb-1.5 uppercase bg-primary rounded-lg hover:bg-opacity-90 text-secondary text-nowrap text-sm">free consultation</a>
            </div>
        </div>
    </nav>
</header>
