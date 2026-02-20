<div id="checout" class="container py-4 mx-auto space-y-8">
    <h1 class="text-2xl font-bold text-center">Checkout</h1>
    {{-- <div class="font-semibold">Order ID: {{ $order->order_number }}</div> --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Name Paket</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Category</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Subcription</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Quantity</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Price</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Subtotal</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($order as $item)
                @php
                    $payload = json_decode($item->payload);
                @endphp
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $item->package->title }}

                        <span class="text-sm text-gray-600">
                            {!! get_sub_package($item->package, $payload->type, $payload->sub_package_key) !!}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->package->category->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->contract_type ?? 'Package' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->quantity }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($payload->package_price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($payload->package_price * $item->quantity, 0, ',', '.') }}</td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="4"></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-medium">Total Amount: </div>
                        <div class="font-semibold">Rp {{ number_format($total_amount, 0, ',', '.') }}</div>
                        <div></div>
                    </td>
                </tr>
            <!-- More rows -->
            </tbody>
        </table>
    </div>
    <div class="flex justify-center">
        <button id="pay-button" wire:loading.attr="disabled" wire:click="submit" class="px-4 pt-1 pb-1.5 uppercase bg-secondary rounded-lg hover:bg-opacity-90 text-primary font-bold text-nowrap inline-flex items-center mt-2 max-md:text-sm md:mt-4">Pay Now</button>
        {{-- <a href="{{ route('frontend.order.payment', $order->order_number) }}" rel="noopener noreferrer" class="px-4 pt-1 pb-1.5 uppercase bg-secondary rounded-lg hover:bg-opacity-90 text-primary font-bold text-nowrap inline-flex items-center mt-2 max-md:text-sm md:mt-4">Pay Now</a> --}}
    </div>
</div>
