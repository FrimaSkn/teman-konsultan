@props([
    'image' => asset('img/asset-1.jpg')
])

<div class="h-40 md:h-[40vh] w-full bg-center bg-no-repeat bg-cover" style="background-image: url('{{ $image }}')"></div>
