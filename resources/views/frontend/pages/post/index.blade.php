@extends('frontend.layouts.app')

@section('title', __('Artikel'))

@section('content')
    <x-frontend.hero-section :image="'/storage/pages/'.$settings->banner_article" />
    <section class="container py-10 md:py-20">
        <div class="text-xl font-semibold text-center uppercase md:text-3xl text-underline">@lang('Article')</div>

        <div class="grid mt-10 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-8" data-motion="inview-fadeup-stg">
            @foreach ($posts as $post)
                <div data-animate="inview-fadeup-stg">
                    <div class="bg-center bg-cover aspect-video" style="background-image: url('{{ $post->getFirstMediaUrl('post_image') }}"></div>
                    <div class="text-lg font-medium">{{ $post->title }}</div>
                    <div class="text-sm text-gray-300">{{ $post->user->name . ' | ' . $post->created_at->format('d M Y') }}</div>
                    <p class="mt-2 max-md:text-sm">{{ $post->excerpt }}</p>
                    <a href="{{ route('frontend.post.show', $post->slug) }}" class="pl-4 pr-2 pt-1 pb-1.5 uppercase bg-secondary rounded-lg hover:bg-opacity-90 text-white text-nowrap inline-flex items-center mt-4">
                        <span>@lang('Read more')</span>
                        <i data-lucide="chevron-right"></i>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="mt-10">
            {{ $posts->links() }}
        </div>
    </section>
@endsection
