@extends('frontend.layouts.app')

@section('title', $post->seo_title)
@section('meta_description', $post->seo_description)

@section('content')
    {{-- <x-frontend.hero-section :image="asset('img/asset-5.jpg')" /> --}}
    <section class="container py-10 md:py-14">
        <img class="w-full object-cover" src="{{ asset($post->getFirstMediaUrl('post_image')) }}" alt="{{ $post->title }}">
        <h1 class="mt-5 text-xl font-semibold uppercase md:text-3xl mb-8">{{ $post->title }}</h1>
        <article class="tiptap-content prose max-w-none">
            {{-- {!! $post->content !!} --}}
            {!! tiptap_converter()->asHTML($post->content) !!}
        </article>
    </section>
@endsection
