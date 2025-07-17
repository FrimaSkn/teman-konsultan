@extends('frontend.layouts.app')

@section('title', __('Home'))

@section('content')
    <div>
        <section class="relative">
            <div class="swiper home-banner-swiper h-60 md:h-[70vh]">
                <div class="swiper-wrapper">
                        @foreach ($settings->banner as $banner)
                            <div class="swiper-slide">
                                <img class="object-cover w-full" src="{{ '/storage/pages/' . $banner['image'] }}" />
                            </div>
                        @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

            <div class="absolute inset-0 text-white">
                <div class="container flex items-center h-full">
                    <div class="md:w-3/4 lg:w-[45%] p-4 md:p-8 bg-black bg-opacity-50 md:ml-10 xl:ml-0 relative z-20" data-motion="inview-fadeup" data-animate>
                        <h3 class="text-lg leading-none md:text-3xl">{{ translate($settings->hero_title) }}</h3>
                        <div class="w-[15%] h-1 md:h-1.5 mt-2 md:mt-4 bg-secondary"></div>
                        <p class="mt-4 text-sm md:mt-7 max-md:leading-none md:text-base">{{ translate($settings->hero_desc) }}</p>
                        <a href="{{ route('frontend.contact-us') }}" class="pl-4 pr-2 pt-1 pb-1.5 uppercase bg-secondary rounded-lg hover:bg-opacity-90 text-primary font-bold text-nowrap inline-flex items-center mt-2 max-md:text-sm md:mt-4">
                            <span>@lang('Read more')</span>
                            <i data-lucide="chevron-right" class="max-md:size-4 "></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <div class="flex justify-between gap-2 px-4 py-4 mt-0 text-white lg:container lg:items-center max-lg:flex-col md:px-8 md:py-6 lg:px-16 lg:py-6 bg-primary md:-mt-10 lg:mt-0" data-motion="inview-faderight-stg">
            <h2 data-animate="inview-faderight-stg" class="text-sm uppercase md:text-base">@lang("Trust your company's tax and accounting needs to us")</h2>
            <a data-animate="inview-faderight-stg" href="" class="pl-4 pr-2 pt-1 pb-1.5 uppercase bg-secondary rounded-lg overflow-hidden w-max max-md:text-sm">
                <span class="flex items-center font-medium text-primary text-nowrap">
                    <span>@lang("Get a quote")</span>
                    <i data-lucide="chevron-right" class="max-md:size-4"></i>
                </span>
            </a>
        </div>

        <section class="container flex flex-col items-center justify-center pt-10 pb-20 space-y-10">
            <h2 class="block text-xl font-semibold uppercase md:text-3xl text-underline" data-motion="inview-fadeup" data-animate>@lang('Our Services')</h2>

            <div class="grid w-full grid-cols-2 gap-4 md:grid-cols-2 lg:grid-cols-4" data-motion="inview-fadeup-stg">
                @foreach ($services as $category)
                    <div x-data="{ open: false }" x-on:mouseenter="open = true" x-on:mouseleave="open = false" data-animate="inview-fadeup-stg"
                        class="relative flex items-center justify-center w-full overflow-hidden bg-cover rounded-lg shadow cursor-default aspect-square" style="background-image: url('{{ $category->getFirstMediaUrl('service_category') }}');">
                        <div x-show="!open" class="flex items-center justify-center w-full h-full p-6 bg-white/60"
                            x-transition:enter="transition ease-in duration-200"
                            x-transition:enter-start="opacity-10 translate-y-20"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-out duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-20">
                            <div class="text-center uppercase md:text-2xl lg:text-[1.7rem]">{{ $category->name }}</div>
                        </div>
                        <div x-show="open"  data-motion="hover-stg" class="absolute top-0 left-0 w-full h-full p-4 text-white rounded-lg bg-primary/85"
                            x-transition:enter="transition ease-in duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-20"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-out duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-20"
                        >
                            <div class="relative flex-col items-center justify-center w-full h-full max-md:flex">
                                <div class="items-center w-full h-5/6 max-md:hidden">
                                    <ol class="text-sm list-disc list-inside">
                                        @foreach ($category->services as $service)
                                            <li hover-fade-right>{{ $service->name }}</li>
                                        @endforeach
                                    </ol>
                                </div>
                                <a href="" class="pl-3 pr-1 py-0.5 uppercase text-sm bg-secondary rounded-lg hover:bg-opacity-90 text-white text-nowrap inline-flex items-center justify-between">
                                    <div>@lang('See detail')</div>
                                    <i data-lucide="chevron-right" class="justify-self-end"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="py-20 bg-gray-200">
            <div class="container grid gap-10 lg:grid-cols-2">
                <div data-motion="inview-fadeleft" data-animate>
                    <img class="aspect-[16/10]" src="{{ '/storage/pages/' . $settings->about_image }}" alt="">
                </div>
                <div data-motion="inview-faderight" data-animate>
                    <div class="inline-block text-xl font-semibold uppercase md:text-3xl text-underline-left">{{ translate($settings->about_title) }}</div>
                    <p class="mt-8">
                        {{ translate($settings->about_description   ) }}
                    </p>
                    <a href="{{ route('frontend.about') }}" class="pl-4 pr-2 pt-1 pb-1.5 uppercase bg-secondary rounded-lg hover:bg-opacity-90 text-white text-nowrap inline-flex items-center mt-4">
                        <span>@lang('Read more')</span>
                        <i data-lucide="chevron-right"></i>
                    </a>
                </div>
            </div>
        </section>

        <section class="container py-20">
            <h2 class="inline-block text-xl font-semibold uppercase md:text-3xl text-underline-left" data-motion="inview-faderight" data-animate>@lang('why choose us?')</h2>
            <div class="grid gap-8 mt-10 md:grid-cols-2 lg:grid-cols-3" data-motion="inview-faderight-stg">
                @foreach ($settings->section_4_content as $content4)
                    <div data-animate="inview-faderight-stg">
                        <div class="h-16 md:h-24 aspect-[9/12] mb-3">
                            <img class="object-contain object-bottom h-full" src="{{ '/storage/pages/' . $content4['icon'] }}" alt="{{ translate($content4['title']) }}">
                        </div>
                        <div class="text-xl font-bold text-primary">{{ translate($content4['title']) }}</div>
                        <p>{{ translate($content4['description']) }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="w-full bg-top bg-no-repeat bg-cover bg_filter" style="background-image: url('{{ asset('img/bg-section-100.jpg') }}')">
            <div class="container relative py-20 md:py-40 z-[2]">
                <p class="inline-block text-white md:text-xl text-underline-left" data-motion="inview-faderight" data-animate="">{!! nl2br(translate($settings->section_5_desc)) !!}</p>
                <div class="flex gap-10 mt-10 md:items-center max-md:flex-col" data-motion="inview-faderight-stg">
                    <div class="text-white" data-animate="inview-faderight-stg">
                        <div class="text-3xl font-light">{{ translate($settings->section_5_money) }}</div>
                        <div class="text-xs font-light uppercase">@lang('Total money we manage')</div>
                    </div>
                    <div class="text-white" data-animate="inview-faderight-stg">
                        <div class="flex items-center gap-2 text-3xl font-light">
                            <img src="{{ asset('img/icons/Asset-7.png') }}" alt="">
                            <span>{{ $settings->section_5_implemented }}</span>
                        </div>
                        <div class="text-xs font-light uppercase">@lang('Tax & Accounting Implemented')</div>
                    </div>
                    <div class="text-white" data-animate="inview-faderight-stg">
                        <div class="flex items-center gap-2 text-3xl font-light">
                            <img src="{{ asset('img/icons/Asset-8.png') }}" alt="">
                            <span>{{ $settings->section_5_client }}</span>
                        </div>
                        <div class="text-xs font-light uppercase">@lang('Satisfied Clients')</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container py-20">
            <div class="inline-block text-xl font-semibold uppercase md:text-3xl text-underline-left" data-motion="inview-faderight" data-animate>@lang('Article')</div>

            <div class="grid mt-10 gap-x-4 gap-y-8 md:gap-4 md:grid-cols-3" data-motion="inview-fadeup-stg">
                @for ($i = 0; $i < 3; $i++)
                <div data-animate="inview-fadeup-stg">
                    <div class="bg-center bg-cover aspect-video" style="background-image: url('{{ asset('img/asset-1.jpg') }}"></div>
                    <div class="text-lg font-medium">Title</div>
                    <div class="text-sm text-gray-300">Author | Date</div>
                    <p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor.</p>
                    <a href="" class="pl-4 pr-2 pt-1 pb-1.5 uppercase bg-secondary rounded-lg hover:bg-opacity-90 text-white text-nowrap inline-flex items-center mt-4">
                        <span>@lang('Read more')</span>
                        <i data-lucide="chevron-right"></i>
                    </a>
                </div>
                @endfor
            </div>
        </section>
    </div>
@endsection
