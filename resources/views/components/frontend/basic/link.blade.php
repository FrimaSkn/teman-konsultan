@props([
    'text' => 'Button',
    'route' => '#',
    'target' => '_self',
    'rel' => 'noopener noreferrer',
    'disabled' => false,
])


<!-- Component: Base link basic button -->
<a
    class="btn-link"
    {{ $attributes->merge(['class' => 'btn-link']) }}
    href="{{ $route }}"
    target="{{ $target }}"
    rel="{{ $rel }}"
    @if($disabled) disabled @endif
>
    <span>
        {{ $text }}
    </span>
</a>
<!-- End Base link basic button -->
