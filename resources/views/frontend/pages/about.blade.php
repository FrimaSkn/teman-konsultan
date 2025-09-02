@extends('frontend.layouts.app')

@section('title', __('Tentang Kami'))
@section('meta_description', strip_tags(translate($settings->content)))

@section('content')
    <x-frontend.hero-section :image="'/storage/pages/'.$settings->banner" />

    <div class="flex justify-between gap-2 px-4 py-4 text-white lg:container md:items-center max-md:flex-col md:px-8 md:py-6 lg:px-16 lg:py-6 bg-primary" data-motion="inview-faderight-stg">
        <h2 data-animate="inview-faderight-stg" class="text-sm md:text-base">@lang("Trust your company's business needs to us")</h2>
        <a href="{{ route('frontend.contact-us', '#form-contact') }}" data-animate="inview-faderight-stg" href="" class="pl-4 pr-2 pt-1 pb-1.5 uppercase bg-secondary rounded-lg overflow-hidden w-max max-md:text-sm">
            <span class="flex items-center font-medium text-primary text-nowrap">
                <span>@lang("Get a quote")</span>
                <i data-lucide="chevron-right" class="max-md:size-4"></i>
            </span>
        </a>
    </div>

    <section class="container py-10 md:py-20" data-motion="inview-fadeup-stg">
        <div class="text-xl font-semibold text-center uppercase md:text-3xl text-underline"  data-animate="inview-fadeup-stg">@lang('About Us')</div>
        <div class="md:mx-[10%] mt-8 md:text-center" data-animate="inview-fadeup-stg">
            {!! translate($settings->content) !!}
        </div>
    </section>
    <section class="grid md:grid-cols-2" data-motion="inview-faderight-stg">
        <div class="px-4 md:px-[15%] bg-gray-300 py-10" >
            <div class="text-xl font-semibold uppercase md:text-3xl text-underline-left" data-animate="inview-faderight-stg">@lang('Value')</div>
            <div class="pt-6 space-y-4">
                @foreach ($settings->values as $value)
                    <div data-animate="inview-faderight-stg">
                        <h3 class="text-base uppercase md:text-xl text-primary">{{ translate($value['title']) }}</h3>
                        <p>{{ translate($value['desc']) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="grid grid-rows-2">
            <div class="py-10 bg-primary px-4 md:px-[10%]">
                <div class="text-xl font-semibold text-white uppercase md:text-3xl text-underline-left" data-animate="inview-faderight-stg">@lang('Vision')</div>
                <ol class="pt-6 ml-4 text-white list-disc">
                    @foreach ($settings->vision as $vision)
                        <li data-animate="inview-faderight-stg">
                            {{ translate($vision['desc']) }}
                        </li>
                    @endforeach
                </ol>
            </div>
            <div class="bg-secondary px-4 md:px-[10%] py-10">
                <div class="text-xl font-semibold uppercase md:text-3xl text-primary text-underline-left-blue" data-animate="inview-faderight-stg">@lang('Mission')</div>
                <ol class="pt-6 ml-4 list-disc">
                    @foreach ($settings->mission as $mission)
                        <li data-animate="inview-faderight-stg">
                            {{ translate($mission['desc']) }}
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </section>
@endsection
