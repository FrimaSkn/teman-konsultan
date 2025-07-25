@props([
    'data' => null,
    'categorySlug' => null,
])
@php
    $packages = [];
    foreach ($data as $package) {
        $wrapped = [
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
                @if (isset($paket['button_text']) && isset($paket['button_url']))
                    <a href="{{ route('frontend.contact-us', '#form-contact') }}" class="pl-4 pr-2 pt-1 pb-1.5 w-56 h-12 uppercase bg-secondary rounded-xl hover:bg-opacity-90 text-primary font-medium text-nowrap inline-flex items-center justify-center">
                        <span>{{ $paket['button_text'][app()->getLocale()] ?? '' }}</span>
                        <i data-lucide="chevron-right"></i>
                    </a>
                @endif
            </div>

            @if (isset($paket['list']))
                <table class="w-full mt-4">
                    <tbody>
                        @foreach ($paket['list'] as $list)
                            <tr class="border-b border-gray-200">
                                <td class="px-4 py-2 font-semibold">{!! $list['key'][app()->getLocale()] ?? '' !!}</td>
                                <td class="px-4 py-2 font-semibold">{!! $list['value'][app()->getLocale()] ?? '' !!}</td>
                                <td class="py-2 text-right">
                                    <a href="{{ route('frontend.contact-us', '#form-contact') }}" class="pl-4 pr-2 pt-1 pb-1.5 w-56 h-12 uppercase bg-secondary rounded-xl hover:bg-opacity-90 text-primary font-medium text-nowrap inline-flex items-center justify-center">
                                        <span>{{ $list['button_text'][app()->getLocale()] ?? '' }}</span>
                                        <i data-lucide="chevron-right"></i>
                                    </a>
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
                        @foreach ($paket['table'] as $tableRow)
                            <tr class="border-b border-gray-200">
                                @foreach ($tableRow['data']['table'][app()->getLocale()] ?? [] as $column)
                                    <td class="px-4 py-2 font-semibold">{!! $column !!}</td>
                                @endforeach
                                <td class="py-2 text-right">
                                    <a href="{{ route('frontend.contact-us', '#form-contact') }}" class="pl-4 pr-2 pt-1 pb-1.5 w-56 h-12 uppercase bg-secondary rounded-xl hover:bg-opacity-90 text-primary font-medium text-nowrap inline-flex items-center justify-center">
                                        <span>{{ $tableRow['data']['button_text'][app()->getLocale()] ?? '' }}</span>
                                        <i data-lucide="chevron-right"></i>
                                    </a>
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
