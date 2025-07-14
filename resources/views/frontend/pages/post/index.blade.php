@extends('frontend.layouts.app')

@section('title', __('Artikel'))

@section('content')
    <x-frontend.hero-section :image="asset('img/asset-5.jpg')" />
    <section class="container py-10 md:py-20">
        <div class="text-xl font-semibold text-center uppercase md:text-3xl text-underline">@lang('Article')</div>

        <div class="grid mt-10 md:grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-8" data-motion="inview-fadeup-stg">
            @for ($i = 0; $i < 9; $i++)
            <div data-animate="inview-fadeup-stg">
                <div class="bg-center bg-cover aspect-video" style="background-image: url('{{ asset('img/asset-1.jpg') }}"></div>
                <div class="text-lg font-medium">Title</div>
                <div class="text-sm text-gray-300">Author | Date</div>
                <p class="mt-2 max-md:text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor.</p>
                <a href="" class="pl-4 pr-2 pt-1 pb-1.5 uppercase bg-secondary rounded-lg hover:bg-opacity-90 text-white text-nowrap inline-flex items-center mt-4">
                    <span>read more</span>
                    <i data-lucide="chevron-right"></i>
                </a>
            </div>
            @endfor
        </div>
    </section>
@endsection
