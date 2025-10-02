@props([
    'data' => null,
    'categorySlug' => null
])

@php
    $packages = [];
    foreach ($data as $package) {
        $wrapped = [
            'id' => $package->id,
            'title' => $package->title,
            'slug' => $package->slug,
            'note' => $package->category->note ?? null,
        ];
        $mapped = Arr::mapWithKeys(json_decode($package->payload), function ($value,  $key) {
            return $value->data;
        });

        $pushed = Arr::map($mapped, function ($value, $key) use (&$wrapped) {
            return $wrapped[$key] = $value;
        });

        $packages[] = json_decode((string) json_encode($wrapped), true);
    }

    $getFristPaket = $packages[0] ?? [];
    // dd($getFristPaket);
@endphp

<div class="flex gap-4 max-md:container">
    <div class="mt-16 space-y-4 md:basis-1/2 lg:basis-[30%] md:ml-[5%] xl:ml-[8%] 2xl:ml-[20%] max-md:hidden">
        @if (array_key_exists('price', $getFristPaket) || array_key_exists('min_contract', $getFristPaket))
            <div>
                @if (array_key_exists('price', $getFristPaket))
                    <div class="text-xl font-semibold leading-tight uppercase">Harga paket</div>
                @endif

                @if (array_key_exists('min_contract', $getFristPaket) && isset($getFristPaket['min_contract']))
                    <div class="text-xl font-semibold leading-tight uppercase">Harga minimum kontrak</div>
                @endif
            </div>
        @endif

        @if (array_key_exists('meeting', $getFristPaket))
            <div>
                @foreach ($getFristPaket['meeting'][app()->getLocale()] ?? [] as $key => $meeting)
                    @if ($loop->first)
                        <div class="font-semibold">{{ $key }}</div>
                    @else
                        <div class="text-sm">{{ $key }}</div>
                    @endif
                @endforeach
            </div>
        @endif

        @if (array_key_exists('pembukuan', $getFristPaket))
            @foreach ($getFristPaket['pembukuan'][app()->getLocale()] ?? [] as $key => $pembukuan)
                <div class="font-semibold">{{ $key }}</div>
            @endforeach
        @endif

        @if (array_key_exists('support', $getFristPaket))
            @foreach ($getFristPaket['support'][app()->getLocale()] ?? [] as $key => $support)
                <div class="font-semibold">{{ $key }}</div>
            @endforeach
        @endif

        @if (array_key_exists('coverage', $getFristPaket))
            <div>
                @foreach ($getFristPaket['coverage'][app()->getLocale()] ?? [] as $key => $coverage)
                    <div class="text-sm">{{ $key }}</div>
                @endforeach
            </div>
        @endif

        @if (array_key_exists('fitur', $getFristPaket))
            <div>
                <div class="font-semibold">FITUR</div>
                @foreach ($getFristPaket['fitur'][app()->getLocale()] ?? [] as $key => $fitur)
                    <div class="text-sm">{{ $key }}</div>
                @endforeach
            </div>
        @endif

        @if (array_key_exists('free', $getFristPaket))
            <div>
                <div class="font-semibold">FREE</div>
                @foreach ($getFristPaket['free'][app()->getLocale()] ?? [] as $key =>$free)
                    <div class="text-sm">{{ $key }}</div>
                @endforeach
            </div>
        @endif

        @if (array_key_exists('additional', $getFristPaket))
            <div>
                <div class="font-semibold">Tambahan</div>
                @foreach ($getFristPaket['additional'][app()->getLocale()] ?? [] as $key => $additional)
                    <div class="text-sm">{{ $key }}</div>
                @endforeach
            </div>
        @endif

        @if (array_key_exists('note', $getFristPaket) && isset($getFristPaket['note']))
            <div>
                <small class="italic">{{ $getFristPaket['note'] }}</small>
            </div>
        @endif
    </div>

    <div class="swiper price-swiper md:basis-1/2 lg:basis-[70%]">
        <div class="swiper-wrapper">
            @foreach ($packages as $paket)
            <div class="swiper-slide !w-72">
                <div class="pb-4 overflow-hidden bg-white shadow rounded-2xl w-72">
                    <div class="py-2.5 bg-primary">
                        @if (array_key_exists('title', $paket) || isset($paket['title']))
                            <div class="text-lg font-semibold leading-none text-center text-white uppercase">{{ $paket['title'] }}</div>
                        @endif
                        @if (array_key_exists('sub_title', $paket) || isset($paket['sub_title']))
                            <div class="text-sm font-semibold leading-none text-center text-white uppercase">{{ $paket['sub_title'][app()->getLocale()] ?? '' }}</div>
                        @endif
                    </div>
                    <div class="px-8 py-2 space-y-4">
                        <div>
                            @if (array_key_exists('price', $paket) || isset($paket['price']))
                                <div class="text-xl font-semibold leading-tight text-center">{{ $paket['price'][app()->getLocale()] ?? '' }}</div>
                            @endif
                            @if (array_key_exists('min_contract', $paket) || isset($paket['min_contract']))
                                @if ($paket['min_contract'] == 12)
                                    <div class="font-semibold leading-tight text-center capitalize">1 @lang('year')</div>
                                @else
                                    @switch($paket['contract_type'])
                                        @case('daily')
                                            <div class="font-semibold leading-tight text-center capitalize">{{ $paket['min_contract'] }} @lang('day')</div>
                                            @break
                                        @case('monthly')
                                            <div class="font-semibold leading-tight text-center capitalize">{{ $paket['min_contract'] }} @lang('month')</div>
                                            @break
                                        @case('yearly')
                                            <div class="font-semibold leading-tight text-center capitalize">{{ $paket['min_contract'] }} @lang('year')</div>
                                            @break
                                        @default

                                    @endswitch
                                @endif
                            @endif
                        </div>

                        @if (array_key_exists('meeting', $paket))
                            <div class="text-center">
                                @foreach ($paket['meeting'][app()->getLocale()] ?? [] as $meeting)
                                    @if ($meeting == null )
                                        <div class="text-sm p-0.5 mx-auto my-1"></div>
                                    @else
                                        <div class="text-sm p-0.5 mx-auto my-1">{{ $meeting }}</div>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        @if (array_key_exists('pembukuan', $paket))
                            @foreach ($paket['pembukuan'][app()->getLocale()] ?? [] as $pembukuan)
                                @if ($paket['pembukuan'] == 'true')
                                    <div class="pt-10 text-center">
                                        <div class="p-0.5  mx-auto my-1 bg-green-500 rounded-full size-4"><i data-lucide="check" class="w-full h-full stroke-white"></i></div>
                                    </div>
                                @else
                                    <div class="pt-10 text-center">
                                        <div class="text-sm">{{ $pembukuan }}</div>
                                    </div>
                                @endif
                            @endforeach
                        @endif

                        @if (array_key_exists('support', $paket))
                            @foreach ($paket['support'][app()->getLocale()] ?? [] as $support)
                                @if ($support == 'true')
                                    <div class="p-0.5 mx-auto my-1 bg-green-500 rounded-full size-4"><i data-lucide="check" class="w-full h-full stroke-white"></i></div>
                                @elseif ($support == 'false')
                                    <div class="p-0.5 mx-auto my-1 bg-red-500 rounded-full size-4"><i data-lucide="x" class="w-full h-full stroke-white"></i></div>
                                @else
                                    <div class="text-sm text-center">{{ $support }}</div>
                                @endif
                            @endforeach
                        @endif

                        @if (array_key_exists('coverage', $paket))
                            <div class="text-center">
                                @foreach ($paket['coverage'][app()->getLocale()] ?? [] as $coverage)
                                    <div class="text-sm">{{ $coverage }}</div>
                                @endforeach
                            </div>
                        @endif

                        @if (array_key_exists('fitur', $paket))
                            <div class="text-center pt-7">
                                @foreach ($paket['fitur'][app()->getLocale()] ?? [] as $key => $fitur)
                                    @if ($fitur == 'true')
                                        <div class="p-0.5 mx-auto my-1 bg-green-500 rounded-full size-4"><i data-lucide="check" class="w-full h-full stroke-white"></i></div>
                                    @elseif ($fitur == 'false')
                                        <div class="p-0.5 mx-auto my-1 bg-red-500 rounded-full size-4"><i data-lucide="x" class="w-full h-full stroke-white"></i></div>
                                    @else
                                        <div class="text-sm">{{ $fitur }}</div>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        @if (array_key_exists('free', $paket))
                            <div class="text-center pt-[1.3rem]">
                                @foreach ($paket['free'][app()->getLocale()] ?? [] as $free)
                                    @if ($free == 'true')
                                        <div class="p-0.5 mx-auto my-1 bg-green-500 rounded-full size-4"><i data-lucide="check" class="w-full h-full stroke-white"></i></div>
                                    @elseif ($free == 'false')
                                        <div class="p-0.5 mx-auto my-1 bg-red-500 rounded-full size-4"><i data-lucide="x" class="w-full h-full stroke-white"></i></div>
                                    @else
                                        <div class="text-sm">{{ $free }}</div>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        @if (array_key_exists('additional', $paket))
                            <div class="pt-[1.5rem] text-center">
                                @foreach ($paket['additional'][app()->getLocale()] ?? [] as $additional)
                                    @if ($additional == 'true')
                                        <div class="p-0.5 mx-auto my-1 bg-green-500 rounded-full size-4"><i data-lucide="check" class="w-full h-full stroke-white"></i></div>
                                    @elseif ($additional == 'false')
                                        <div class="p-0.5 mx-auto my-1 bg-red-500 rounded-full size-4"><i data-lucide="x" class="w-full h-full stroke-white"></i></div>
                                    @else
                                        <div class="p-0.5 mx-auto my-1 bg-red-500 rounded-full size-4 opacity-0"><i data-lucide="x" class="w-full h-full stroke-white"></i></div>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        @if ($paket['button_type'] == 'order')
                            <x-frontend.charge.include.btn-form :paket="$paket" :key="$key" type="slider" minContract="{{ $paket['min_contract'] ?? 1 }}" contractType="{{ $paket['contract_type'] ?? null }}" />
                        @endif


                        @if ($paket['button_type'] == 'contact')
                            <div class="flex justify-center">
                                <a href="{{ route('frontend.contact-us', '#form-contact') }}"
                                    class="pl-4 pr-2 pt-2 pb-2.5 uppercase bg-secondary rounded-xl hover:bg-opacity-90 text-primary font-medium text-nowrap inline-flex items-center mt-4 justify-center w-full">
                                    <span>@lang('Contact Us')</span>
                                    <i data-lucide="chevron-right" class="size-4"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-scrollbar"></div>
    </div>

</div>
