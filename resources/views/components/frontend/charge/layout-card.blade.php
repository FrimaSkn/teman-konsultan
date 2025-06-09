@props([
    'data' => null
])

<div class="container mt-10 space-y-8">
    @foreach ($data['paket'] as $paket)
        <div class="w-full px-8 py-6 text-left bg-white shadow rounded-3xl">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-semibold uppercase text-primary">
                    <span>
                        {{ count($data['paket']) > 1 ? $loop->iteration . '. ' : '' }}
                    </span>
                    <span>{{ $paket['title'] }}</span>
                </h3>
                @if (isset($paket['sub_title']))
                    <div class="font-medium leading-none">{{ $paket['sub_title'] }}</div>
                @endif
                @if (isset($paket['button']))
                    <a href="{{ $paket['button']['url'] }}" class="pl-4 pr-2 pt-1 pb-1.5 w-56 h-12 uppercase bg-secondary rounded-xl hover:bg-opacity-90 text-primary font-medium text-nowrap inline-flex items-center justify-center">
                        <span>{{ $paket['button']['text'] }}</span>
                        <i data-lucide="chevron-right"></i>
                    </a>
                @endif
            </div>

            @if (isset($paket['table']) || isset($paket['table_header']))
                <table class="w-full mt-4">
                    @if (isset($paket['table_header']))
                        <thead>
                            <tr>
                                @foreach ($paket['table_header'] as $header)
                                    <th class="px-4 py-2 text-left uppercase">{{ $header }}</th>
                                @endforeach
                            </tr>
                        </thead>
                    @endif
                    <tbody>
                        @foreach ($paket['table'] as $tableRow)
                            <tr class="border-b border-gray-200">
                                @foreach ($tableRow['cells'] as $cell)
                                    <td class="px-4 py-2 font-semibold">{!! $cell !!}</td>
                                @endforeach
                                <td class="py-2 text-right">
                                    <a href="{{ $tableRow['button']['url'] }}" class="pl-4 pr-2 pt-1 pb-1.5 w-56 h-12 uppercase bg-secondary rounded-xl hover:bg-opacity-90 text-primary font-medium text-nowrap inline-flex items-center justify-center">
                                        <span>{{ $tableRow['button']['text'] }}</span>
                                        <i data-lucide="chevron-right"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endforeach
</div>
