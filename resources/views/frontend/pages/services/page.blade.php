@extends('frontend.layouts.app')

@section('title', $service->name)

@section('meta_description', strip_tags($service->description))

@php
    if ($service->page_content !== null) {
        $contents = json_decode($service->page_content);


        $banner = collect($contents)->filter(function ($item) {
            return $item->type === 'banner';
        })->first();

        if ($banner != null) {
            $banner = $banner->data->content;
            $banner = "/storage/service/" . $banner;
        }
    }
@endphp


@push('after-styles')
    <style>
           .service-page ul,
            .service-page ol {
                list-style: revert;
                margin-left: 1.25rem; /* Adjust as needed for desired indentation */
            }
    </style>

@endpush

@section('content')
    @if ($service->page_content != null && $service->page_content != '')
        @if (isset($banner))
            <x-frontend.hero-section image="{{ $banner }}" />
        @endif

        <section class="container py-10 md:py-20 service-page">
            @foreach ($contents as $content)

                @if ($content->type === 'heading')
                    <div class="{{ getClass($content->data->level, $content->data->alignment) }} font-semibold uppercase my-8">
                        {{ translate($content->data->content) }}
                    </div>
                @elseif ($content->type === 'paragraph')
                    <div class="my-6">
                        {!! translate($content->data->content) !!}
                    </div>
                @elseif ($content->type === 'image')
                    <div class="flex justify-center my-6">
                        <img src="{{ asset('storage/service/' . $content->data->content) }}" alt="" class="w-full h-auto max-w-full">
                    </div>
                @elseif ($content->type === 'button')
                    <div class="flex my-4 {{ getClass('', $content->data->alignment) }}">
                        <a href="{{ $content->data->url }}" class="px-4 py-2 text-white rounded bg-primary hover:bg-secondary">
                            {{ translate($content->data->text) }}
                        </a>
                    </div>
                @elseif ($content->type === 'whatsapp')
                    <div class="flex my-6 {{ getClass('', $content->data->alignment) }}">
                        <a href="https://wa.me/{{ $content->data->whatsapp }}" target="_blank" class="flex items-center gap-1 px-4 py-2 text-white rounded bg-[#25D366] hover:bg-secondary">
                            <i data-lucide="message-circle-more"></i>  {{ translate($content->data->text) }}
                        </a>
                    </div>
                @endif
            @endforeach
        </section>

    @else
        <section class="container h-[60svh]">
            <div class="flex items-center justify-center h-full text-xl font-semibold text-center">
                @lang('Halaman Tidak Tersedia')
            </div>
        </section>
    @endif
@endsection
