@props([
    'icon' => null,
    'iconHtml' => null,
    'label' => 'Button',
    'type' => 'primary',
    'size' => 'md',
    'hide' => false,
])

@if ($hide)
    @php
        return;
    @endphp
@endif

<!-- Component: basic button -->
<button
    class="btn btn-{{ $type }} btn-{{ $size }}"
    {{ $attributes->merge(['class' => 'btn btn-'.$type.' btn-'.$size]) }}
>
    <span>
        {{ $label }}
    </span>

    @if ($iconHtml !== null)
        {{ $iconHtml }}
    @elseif ($icon)
        <span class="relative only:-mx-5">
            <i class="{{ $icon }}"></i>
        </span>
    @endif

</button>
<!-- End basic button -->
