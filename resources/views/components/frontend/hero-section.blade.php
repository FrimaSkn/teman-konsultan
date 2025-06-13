@props([
    'image' => asset('img/bg-hero-2.jpg')
])

<div class="h-60 md:h-[40vh] w-full bg-center bg-no-repeat bg-cover" style="background-image: url('{{ $image }}')"></div>
