<div class="container p-4 mx-auto">
    <div class="space-y-4">
        @php
        // dd($totalPrice);
            arsort($items);
        @endphp
        @foreach ($items as $itemKey => $item)
            <div wire:loading.class="opacity-50" class="gap-8 px-4 border border-gray-200 rounded-sm ps-4 dark:border-gray-700">
                <label for="{{ 'paket-'.$item['id'] }}" class="grid grid-cols-8 py-4">
                    <div class="col-span-4">
                        <h3 class="text-lg font-semibold">{{ $item['package_name'] }}</h3>
                        @switch($item['type'])
                            @case('table')
                                <ul class="text-gray-600">
                                    @foreach ($item['sub_package'][app()->getLocale()] as $key => $value)
                                        <li class="mb-1">{{ $key }}: {{ $value }}</li>
                                    @endforeach
                                </ul>
                                @break
                            @case('list')
                                @php
                                    $key = (array) $item['sub_package']['key'];
                                    $value = (array) $item['sub_package']['value'];
                                @endphp
                                <ul class="text-gray-600">
                                    <li>{{ $key[app()->getLocale()] }} : {{ $value[app()->getLocale()] }}</li>
                                </ul>
                                @break
                            @default
                                <p class="font-semibold text-gray-600">{{ $item['category'] }}</p>
                        @endswitch
                        <h4 class="font-semibold text-gray-900">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</h4>
                    </div>
                    <div class="self-center max-w-xs col-span-3">
                        @switch($item['contract_type'])
                            @case('daily')
                                <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-900">Subcription / day:</label>
                                <div class="relative flex items-center px-2 border border-gray-200 rounded-full w-min">
                                    <button wire:click="decrementQuantity({{ $item['id'] }}, {{ $itemKey }})" type="button" id="decrement-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-minus-icon lucide-circle-minus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/></svg>
                                    </button>
                                    <input type="text" wire:change="updateQuantity({{ $item['id'] }}, $event.target.value)" minlength="12" id="quantity-input" class="text-center block p-2.5" placeholder="0" value="{{ $item['quantity'] }}" readonly />
                                    <button wire:click="incrementQuantity({{ $item['id'] }}, {{ $itemKey }})" type="button" id="increment-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                                    </button>
                                </div>
                                @break
                            @case('monthly')
                                <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-900">Subcription / month:</label>
                                <div class="relative flex items-center px-2 border border-gray-200 rounded-full w-min">
                                    <button wire:click="decrementQuantity({{ $item['id'] }}, {{ $itemKey }})" type="button" id="decrement-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-minus-icon lucide-circle-minus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/></svg>
                                    </button>
                                    <input type="text" wire:change="updateQuantity({{ $item['id'] }}, $event.target.value)" minlength="12" id="quantity-input" class="text-center block p-2.5" placeholder="0" value="{{ $item['quantity'] }}" readonly />
                                    <button wire:click="incrementQuantity({{ $item['id'] }}, {{ $itemKey }})" type="button" id="increment-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                                    </button>
                                </div>
                                @break
                            @case('yearly')
                                <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-900">Subcription / year:</label>
                                <div class="relative flex items-center px-2 border border-gray-200 rounded-full w-min">
                                    <button wire:click="decrementQuantity({{ $item['id'] }}, {{ $itemKey }})" type="button" id="decrement-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-minus-icon lucide-circle-minus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/></svg>
                                    </button>
                                    <input type="text" wire:change="updateQuantity({{ $item['id'] }}, $event.target.value)" minlength="12" id="quantity-input" class="text-center block p-2.5" placeholder="0" value="{{ $item['quantity'] }}" readonly />
                                    <button wire:click="incrementQuantity({{ $item['id'] }}, {{ $itemKey }})" type="button" id="increment-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                                    </button>
                                </div>
                                @break
                            @case('periode')
                                <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-900">Subcription / periode:</label>
                                <div>{{ $item['quantity'] }}x</div>
                                 @break
                            @default
                                <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-900">Subcription:</label>
                                <div>{{ $item['quantity'] }}x</div>
                        @endswitch
                        @if ($item['message'] != null)
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $item['message'] }}</p>
                        @endif
                    </div>
                    <div class="self-center col-span-1 justify-self-end">
                        <button wire:click="removeItem({{ $item['id'] }}, {{ $itemKey }})" class="p-2 text-red-600 bg-red-100 rounded-full hover:bg-red-200 ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        </button>
                    </div>
                </label>
            </div>
        @endforeach
    </div>

    <div>
        @if ($totalPrice == 0)
            <div class="flex items-center justify-center w-full text-3xl font-bold text-center h-[50vh]">@lang('No Item')</div>
        @else
            <div class="flex items-center justify-between px-4 py-2">
                <div class="text-lg font-semibold">
                    Total: Rp {{ number_format($totalPrice, 0, ',', '.') }}
                </div>
                <button wire:loading.attr="disabled" wire:click="checkout" class="px-2 pt-1 pb-1.5 uppercase bg-secondary rounded-lg hover:bg-opacity-90 text-primary font-bold text-nowrap inline-flex items-center mt-2 max-md:text-sm md:mt-4">Checkout</button>
            </div>
        @endif
    </div>
</div>
