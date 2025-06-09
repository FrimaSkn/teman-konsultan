<div class="flex gap-4">
    @php
        $pricelist = config('web-data.charges');

        $getCategory = $pricelist['akuntansi_perpajakan'];

        $getFristPaket = Arr::first($getCategory['paket']);
    @endphp
    <div class="mt-16 space-y-4 basis-[30%] lg:ml-[5%] xl:ml-[8%] 2xl:ml-[20%]">
        <div>
            <div class="text-xl font-semibold leading-tight uppercase">Haraga paket</div>
            <div class="font-semibold leading-tight uppercase" >minimum kontrak</div>
        </div>

        <div>
            @foreach ($getFristPaket['coverage'] as $coverage)
                <div class="text-sm">{{ $coverage['key'] }}</div>
            @endforeach
        </div>

        <div>
            <div class="font-semibold">FITUR</div>
            @foreach ($getFristPaket['fitur'] as $fitru)
                <div class="text-sm">{{ $fitru['key'] }}</div>
            @endforeach
        </div>

        <div>
            <div class="font-semibold">FREE</div>
            @foreach ($getFristPaket['free'] as $free)
                <div class="text-sm">{{ $free['key'] }}</div>
            @endforeach
        </div>

        <div>
            <div class="font-semibold">Gambaran dokument yang diperluakan</div>
            @foreach ($getFristPaket['additional'] as $additional)
                <div class="text-sm">{{ $additional['key'] }}</div>
            @endforeach
        </div>

        <div>
            <small class="italic">* {{ $getCategory['note'] }}</small>
        </div>
    </div>

    <div class="swiper price-swiper basis-[70%]">
        <div class="swiper-wrapper">
            @foreach ($getCategory['paket'] as $paket)
            <div class="swiper-slide !w-72">
                <div class="pb-4 overflow-hidden bg-white shadow rounded-2xl w-72">
                    <div class="py-2.5 bg-primary">
                        <div class="text-lg font-semibold leading-none text-center text-white uppercase">{{ $paket['title'] }}</div>
                        <div class="text-xs font-semibold leading-none text-center text-white uppercase">{{ $paket['sub_title'] }}</div>
                    </div>
                    <div class="px-8 py-2 space-y-4">
                        <div>
                            <div class="text-xl font-semibold leading-tight text-center">{{ $paket['price'] }}</div>
                            <div class="font-semibold leading-tight text-center">{{ $paket['min_contract'] }}</div>
                        </div>
                        <div class="text-center">
                            @foreach ($paket['coverage'] as $coverage)
                                <div class="text-sm">{{ $coverage['value'] }}</div>
                            @endforeach
                        </div>
                        <div class="text-center pt-7">
                            @foreach ($paket['fitur'] as $fitru)
                                @if ($fitru['value'] == 'true')
                                    <div class="p-0.5 mx-auto my-1 bg-green-500 rounded-full size-4"><i data-lucide="check" class="w-full h-full stroke-white"></i></div>
                                @elseif ($fitru['value'] == 'false')
                                    <div class="p-0.5 mx-auto my-1 bg-red-500 rounded-full size-4"><i data-lucide="x" class="w-full h-full stroke-white"></i></div>
                                @else
                                    <div class="text-sm">-</div>
                                @endif
                            @endforeach
                        </div>
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
