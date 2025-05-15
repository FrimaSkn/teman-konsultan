@props([
    'items',
    'label' => 'Choose one',
    'size' => 'md',
])

<!-- Component: Icon dropdown menu -->
<div class="dropdown"
    x-data="{ open: false }"
    x-on:click.away="open = false"
    >
    <!-- Start Dropdown trigger -->

    <x-frontend.basic.button
        @click="open = !open"
        :label="$label"
        :size="$size"
        role="button"
        aria-haspopup="true"
        aria-expanded="false">

        <x-slot:iconHtml>
            <span class="relative only:-mx-5"
                x-bind:class="{ 'rotate-180': open }"
                >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.5" aria-labelledby="t-01 d-01" role="graphics-symbol">
                    <title id="t-01">Dropdown icon</title>
                    <desc id="d-01">
                        if closed: "Select an option", if open: "Close the dropdown"
                    </desc>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </span>
        </x-slot>

    </x-frontend.basic.button>
    <!-- End Dropdown trigger -->

    @if ($items->isEmpty())
        <div class="dropdown-item">
            <span class="text-gray-500">
                No items found
            </span>
        </div>

    @else
        <!-- Start Menu list -->
        <ul
            x-cloak
            x-show="open"
            class="dropdown-menu">
            {{ $items }}
        </ul>
        <!-- End Menu list -->

    @endif
</div>
<!-- End Icon dropdown menu -->
