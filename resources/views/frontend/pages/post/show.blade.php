@extends('frontend.layouts.app')

@section('title', __('Artikel'))
@section('meta_description', $post->excerpt)

@section('content')
    {{-- <x-frontend.hero-section :image="asset('img/asset-5.jpg')" /> --}}
    <section class="container py-10 md:py-16">
        <img class="md:!h-[60vh] w-full object-cover" src="{{ asset($post->getFirstMediaUrl('post_image')) }}" alt="">
        <h1 class="my-5 text-xl font-semibold uppercase md:text-3xl">{{ $post->title }}</h1>
        <div>
            {!! $post->content !!}
        </div>
    </section>
@endsection
