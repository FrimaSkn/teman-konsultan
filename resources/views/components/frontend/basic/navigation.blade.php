
@props([
    'menuItems'
])

<header
    class="navigation-wrapper">
    <div class="navigation-container">
        <nav aria-label="main navigation"
            class="navigation" role="navigation">
            <!-- Brand logo -->

            <a id="WindUI" aria-label="WindUI logo" aria-current="page"
                class="flex items-center gap-2 py-3 text-lg whitespace-nowrap focus:outline-none lg:flex-1 font-medium"
                href="javascript:void(0)">
                {{ $brandLogo }}
                {{ $brancName ?? appName() }}
            </a>
            <!-- Mobile trigger -->
            <button class="relative self-center order-10 visible block w-10 h-10 opacity-100 lg:hidden"
                aria-expanded="false" aria-label="Toggle navigation">
                <div class="absolute w-6 transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                    <span aria-hidden="true"
                        class="absolute block h-0.5 w-9/12 -translate-y-2 transform rounded-full bg-slate-900 transition-all duration-300"></span>
                    <span aria-hidden="true"
                        class="absolute block h-0.5 w-6 transform rounded-full bg-slate-900 transition duration-300"></span>
                    <span aria-hidden="true"
                        class="absolute block h-0.5 w-1/2 origin-top-left translate-y-2 transform rounded-full bg-slate-900 transition-all duration-300"></span>
                </div>
            </button>
            <!-- Navigation links -->
            @if(config('boilerplate.locale.status') && count(config('boilerplate.locale.languages')) > 1)

                <x-frontend.basic.dropdown
                    label="{{ getLocaleName(app()->getLocale()) }}"
                    size="sm" >

                    <x-slot:items>
                        @foreach(collect(config('boilerplate.locale.languages'))->sortBy('name') as $code => $details)
                            @if($code !== app()->getLocale())
                                <li>
                                    <a class="dropdown-item"
                                        :text="__(getLocaleName($code))"
                                        href="{{route('locale.change', $code)}}">
                                        <span class="flex flex-col gap-1 overflow-hidden whitespace-nowrap">
                                        <span class="truncate">{{__(getLocaleName($code))}}</span>
                                        </span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </x-slot:items>

                </x-frontend.basic.dropdown>

            @endif

            @if (!$menuItems->isEmpty())
                <ul role="menubar" aria-label="Select page"
                    class="menu-items">
                    {{ $menuItems }}
                </ul>
            @endif
        </nav>
    </div>
</header>
