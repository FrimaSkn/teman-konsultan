@extends('frontend.layouts.app')

@section('title', __('Artikel'))

@section('content')
    <x-frontend.hero-section :image="asset('img/bg-hero-1.jpg')" />
    <section class="container py-20">
        <div class="text-3xl font-semibold text-center uppercase text-underline">@lang('Article')</div>

        <div class="grid grid-cols-3 mt-10 gap-x-4 gap-y-8">
            @for ($i = 0; $i < 9; $i++)
            <div>
                <div class="bg-center bg-cover aspect-video" style="background-image: url('{{ asset('img/thumb-1.jpg') }}"></div>
                <div class="text-lg font-medium">Title</div>
                <div class="text-sm text-gray-300">Author | Date</div>
                <p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor.</p>
                <a href="" class="pl-4 pr-2 pt-1 pb-1.5 uppercase bg-secondary rounded-lg hover:bg-opacity-90 text-white text-nowrap inline-flex items-center mt-4">
                    <span>read more</span>
                    <i data-lucide="chevron-right"></i>
                </a>
            </div>
            @endfor
        </div>
    </section>
@endsection
