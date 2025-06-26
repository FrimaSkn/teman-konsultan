@props([
    'data' => null
])
@php
    $getFristPaket = Arr::first($data['paket']);
@endphp

<div class="flex gap-4">
    <div class="mt-16 space-y-4 basis-[30%] lg:ml-[5%] xl:ml-[8%] 2xl:ml-[20%]">
        @if (array_key_exists('price', $getFristPaket) || array_key_exists('min_contract', $getFristPaket))
            <div>
                @if (array_key_exists('price', $getFristPaket))
                    <div class="text-xl font-semibold leading-tight uppercase">Haraga paket</div>
                @endif

                @if (array_key_exists('min_contract', $getFristPaket) && isset($getFristPaket['min_contract']))
                    <div class="text-xl font-semibold leading-tight uppercase">Harga minimum kontrak</div>
                @endif
            </div>
        @endif

        @if (array_key_exists('meeting', $getFristPaket))
            <div>
                <div class="font-semibold">Jumlah Pertemuan Offline / Bulan</div>
                @foreach ($getFristPaket['meeting'] as $meeting)
                    <div class="text-sm">{{ $meeting['key'] }}</div>
                @endforeach
            </div>
        @endif

        @if (array_key_exists('pembukuan', $getFristPaket))
            <div>
                <div class="font-semibold">{{ $getFristPaket['pembukuan']['key'] }}</div>
            </div>
        @endif

        @if (array_key_exists('support', $getFristPaket))
            <div>
                <div class="font-semibold">{{ $getFristPaket['support']['key'] }}</div>
            </div>
        @endif

        @if (array_key_exists('coverage', $getFristPaket))
            <div>
                @foreach ($getFristPaket['coverage'] as $coverage)
                    <div class="text-sm">{{ $coverage['key'] }}</div>
                @endforeach
            </div>
        @endif

        @if (array_key_exists('fitur', $getFristPaket))
            <div>
                <div class="font-semibold">FITUR</div>
                @foreach ($getFristPaket['fitur'] as $fitru)
                    <div class="text-sm">{{ $fitru['key'] }}</div>
                @endforeach
            </div>
        @endif

        @if (array_key_exists('free', $getFristPaket))
            <div>
                <div class="font-semibold">FREE</div>
                @foreach ($getFristPaket['free'] as $free)
                    <div class="text-sm">{{ $free['key'] }}</div>
                @endforeach
            </div>
        @endif

        @if (array_key_exists('additional', $getFristPaket))
            <div>
                <div class="font-semibold">Tambahan</div>
                @foreach ($getFristPaket['additional'] as $additional)
                    <div class="text-sm">{{ $additional['key'] }}</div>
                @endforeach
            </div>
        @endif

        @if (array_key_exists('note', $data) && isset($data['note']))
            <div>
                <small class="italic">* {{ $data['note'] }}</small>
            </div>
        @endif
    </div>

    <div class="swiper price-swiper basis-[70%]">
        <div class="swiper-wrapper">
            @foreach ($data['paket'] as $paket)
            <div class="swiper-slide !w-72">
                <div class="pb-4 overflow-hidden bg-white shadow rounded-2xl w-72">
                    <div class="py-2.5 bg-primary">
                        @if (array_key_exists('title', $paket) || isset($paket['title']))
                            <div class="text-lg font-semibold leading-none text-center text-white uppercase">{{ $paket['title'] }}</div>
                        @endif
                        @if (array_key_exists('sub_title', $paket) || isset($paket['sub_title']))
                            <div class="text-sm font-semibold leading-none text-center text-white uppercase">{{ $paket['sub_title'] }}</div>
                        @endif
                    </div>
                    <div class="px-8 py-2 space-y-4">
                        <div>
                            @if (array_key_exists('price', $paket) || isset($paket['price']))
                                <div class="text-xl font-semibold leading-tight text-center">{{ $paket['price'] }}</div>
                            @endif
                            @if (array_key_exists('min_contract', $paket) || isset($paket['min_contract']))
                                <div class="font-semibold leading-tight text-center">{{ $paket['min_contract'] }}</div>
                            @endif
                        </div>

                        @if (array_key_exists('meeting', $paket))
                            <div class="text-center">
                                @foreach ($paket['meeting'] as $meeting)
                                    <div class="text-sm p-0.5 mx-auto my-1">{{ $meeting['value'] }}</div>
                                @endforeach
                            </div>
                        @endif

                        @if (array_key_exists('pembukuan', $paket))
                            <div class="pt-10 text-center">
                                <div class="text-sm">{{ $paket['pembukuan']['value'] }}</div>
                            </div>
                        @endif

                        @if (array_key_exists('support', $paket))
                            @if ($paket['support']['value'] == 'true')
                                <div class="p-0.5 mx-auto my-1 bg-green-500 rounded-full size-4"><i data-lucide="check" class="w-full h-full stroke-white"></i></div>
                            @else
                                <div class="p-0.5 mx-auto my-1 bg-red-500 rounded-full size-4"><i data-lucide="x" class="w-full h-full stroke-white"></i></div>
                            @endif
                        @endif

                        @if (array_key_exists('coverage', $paket))
                            <div class="text-center">
                                @foreach ($paket['coverage'] as $coverage)
                                    <div class="text-sm">{{ $coverage['value'] }}</div>
                                @endforeach
                            </div>
                        @endif

                        @if (array_key_exists('fitur', $paket))
                            <div class="text-center pt-7">
                                @foreach ($paket['fitur'] as $fitur)
                                    @if ($fitur['value'] == 'true')
                                        <div class="p-0.5 mx-auto my-1 bg-green-500 rounded-full size-4"><i data-lucide="check" class="w-full h-full stroke-white"></i></div>
                                    @elseif ($fitur['value'] == 'false')
                                        <div class="p-0.5 mx-auto my-1 bg-red-500 rounded-full size-4"><i data-lucide="x" class="w-full h-full stroke-white"></i></div>
                                    @else
                                        <div class="text-sm">-</div>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        @if (array_key_exists('free', $paket))
                            <div class="text-center pt-[1.3rem]">
                                @foreach ($paket['free'] as $free)
                                    @if ($free['value'] == 'true')
                                        <div class="p-0.5 mx-auto my-1 bg-green-500 rounded-full size-4"><i data-lucide="check" class="w-full h-full stroke-white"></i></div>
                                    @elseif ($free['value'] == 'false')
                                        <div class="p-0.5 mx-auto my-1 bg-red-500 rounded-full size-4"><i data-lucide="x" class="w-full h-full stroke-white"></i></div>
                                    @else
                                        <div class="text-sm">{{ $free['value'] }}</div>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        @if (array_key_exists('additional', $paket))
                            <div class="pt-[1.5rem] text-center">
                                @foreach ($paket['additional'] as $additional)
                                    @if ($additional['value'] == 'true')
                                        <div class="p-0.5 mx-auto my-1 bg-green-500 rounded-full size-4"><i data-lucide="check" class="w-full h-full stroke-white"></i></div>
                                    @elseif ($additional['value'] == 'false')
                                        <div class="p-0.5 mx-auto my-1 bg-red-500 rounded-full size-4"><i data-lucide="x" class="w-full h-full stroke-white"></i></div>
                                    @else
                                        <div class="p-0.5 mx-auto my-1 bg-red-500 rounded-full size-4 opacity-0"><i data-lucide="x" class="w-full h-full stroke-white"></i></div>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        <div class="flex justify-center">
                            <a href="" class="pl-4 pr-2 pt-2 pb-2.5 uppercase bg-secondary rounded-xl hover:bg-opacity-90 text-primary font-medium text-nowrap inline-flex items-center mt-4 justify-center w-full">
                                <span>ambil paket</span>
                                <i data-lucide="chevron-right" class="size-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

</div>
