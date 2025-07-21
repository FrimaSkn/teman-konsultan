<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
     @php
        $gmapsOffile = $evaluate(fn ($get) => $get('gmap_head_office'));
        $gmapsWorkshop = $evaluate(fn ($get) => $get('gmap_workshop'));
    @endphp
    @if ($gmapsOffile)
        <div class="font-semibold">Maps Head Office</div>
        <div class="w-full aspect-video">
            {!! $gmapsOffile !!}
        </div>
    @endif

    @if ($gmapsWorkshop)
        <div class="mt-5 font-semibold">Maps Workshop</div>
        <div class="w-full aspect-video">
            {!! $gmapsWorkshop !!}
        </div>
    @endif
    <!-- Field -->
</x-dynamic-component>
