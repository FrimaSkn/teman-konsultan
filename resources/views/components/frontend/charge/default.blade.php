@props([
    'data' => null,
    'categorySlug' => null,
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
@endphp

<div class="container mt-10 space-y-8">
    @foreach ($packages as $paket)
        <div class="w-full px-8 py-6 overflow-x-auto text-left bg-white shadow rounded-3xl">
            <div class="flex justify-between md:items-center max-md:flex-col max-md:gap-4">
                <h3 class="text-xl font-semibold uppercase text-primary">
                    <span>
                        {{ count($packages) > 1 ? $loop->iteration . '. ' : '' }}
                    </span>
                    <span>{{ $paket['title'] }}</span>
                </h3>
                @if (isset($paket['sub_title']))
                    <div class="font-medium leading-none">{{ $paket['sub_title'][app()->getLocale()] ?? '' }}</div>
                @endif

                @if (isset($paket['button_type']))
                    @if ($paket['button_type'] == 'order')
                        <x-frontend.charge.include.btn-form :paket="$paket" packagePrice="{{ $paket['package_price'] ?? 0 }}" :type="'default'" minContract="{{ $paket['min_contract'] ?? 1 }}" contractType="{{ $paket['contract_type'] ?? null }}"  />
                    @endif

                    @if ($paket['button_type'] == 'contact')
                        <a href="{{ route('frontend.contact-us', '#form-contact') }}" class="pl-4 pr-2 pt-1 pb-1.5 w-56 h-12 uppercase bg-secondary rounded-xl hover:bg-opacity-90 text-primary font-medium text-nowrap inline-flex items-center justify-center">
                            <span>@lang('Contact Us')</span>
                            <i data-lucide="chevron-right"></i>
                        </a>
                    @endif
                @endif
            </div>

            @if (isset($paket['list']))
                <table class="w-full mt-4">
                    <tbody>
                        @foreach ($paket['list'] as $key => $list)
                            <tr class="border-b border-gray-200">
                                <td class="px-4 py-2 font-semibold">{!! $list['key'][app()->getLocale()] ?? '' !!}</td>
                                <td class="px-4 py-2 font-semibold">{!! $list['value'][app()->getLocale()] ?? '' !!}</td>
                                <td class="py-2 text-right">

                                    @if ($list['button_type'] == 'order')
                                        <x-frontend.charge.include.btn-form :paket="$paket" packagePrice="{{ $list['package_price'] ?? 0 }}" :key="$key" :type="'list'" minContract="{{ $list['min_contract'] ?? 1 }}" contractType="{{ $list['contract_type'] ?? null }}" />
                                    @endif

                                    @if ($list['button_type'] == 'contact')
                                        <a href="{{ route('frontend.contact-us', '#form-contact') }}" class="pl-4 pr-2 pt-1 pb-1.5 w-56 h-12 uppercase bg-secondary rounded-xl hover:bg-opacity-90 text-primary font-medium text-nowrap inline-flex items-center justify-center">
                                            <span>@lang('Contact Us')</span>
                                            <i data-lucide="chevron-right"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            @if (isset($paket['table']))
                <table class="w-full mt-4">
                    <thead>
                        <tr>
                            @foreach ($paket['table'][0]['data']['table'][app()->getLocale()] ?? [] as $key => $header)
                                <th class="px-4 py-2 text-left uppercase">{{ $key }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paket['table'] as $key => $tableRow)
                            <tr class="border-b border-gray-200">
                                @foreach ($tableRow['data']['table'][app()->getLocale()] ?? [] as $column)
                                    <td class="px-4 py-2 font-semibold">{!! $column !!}</td>
                                @endforeach
                                <td class="py-2 text-right">
                                     @if ($tableRow['data']['button_type'] == 'order')
                                        <x-frontend.charge.include.btn-form :paket="$paket" packagePrice="{{ $tableRow['data']['package_price'] ?? 0 }}" :key="$key" :type="'table'" minContract="{{ $tableRow['data']['min_contract'] ?? 1 }}" contractType="{{ $tableRow['data']['contract_type'] ?? null }}" />
                                    @endif

                                    @if ($tableRow['data']['button_type'] == 'contact')
                                        <a href="{{ route('frontend.contact-us', '#form-contact') }}" class="pl-4 pr-2 pt-1 pb-1.5 w-56 h-12 uppercase bg-secondary rounded-xl hover:bg-opacity-90 text-primary font-medium text-nowrap inline-flex items-center justify-center">
                                            <span>@lang('Contact Us')</span>
                                            <i data-lucide="chevron-right"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            @if (isset($paket['text_editor']))
                <div class="mt-4 text-sm">
                    {!! $paket['text_editor'][app()->getLocale()] ?? '' !!}
                </div>
            @endif
        </div>
    @endforeach
</div>
