@extends('frontend.layouts.app')

@section('title', __('Artikel'))
@section('meta_description', $post->excerpt)

@section('content')
    {{-- <x-frontend.hero-section :image="asset('img/asset-5.jpg')" /> --}}
    <section class="container py-10 md:py-14">
        <img class="w-full object-cover" src="{{ asset($post->getFirstMediaUrl('post_image')) }}" alt="">
        <h1 class="mt-5 text-xl font-semibold uppercase md:text-3xl mb-8">{{ $post->title }}</h1>
        <article class="tiptap-content prose max-w-none">
            {!! tiptap_converter()->asHTML($post->content) !!}
        </article>
    </section>
@endsection
