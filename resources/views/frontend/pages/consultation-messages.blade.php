@extends('frontend.layouts.app')

@section('title', __('Consultation Message'))

@section('content')
    <x-frontend.hero-section :image="asset('img/asset-1.jpg')" />

    <section class="container py-20">
        <div class="text-xl font-semibold text-center uppercase md:text-3xl text-underline">@lang('Thank you')</div>

        <p class="pt-10 mx-auto text-center md:w-3/5">@lang('Your consultation need has been registered. You will be contacted for scheduling.')</p>
    </section>
@endsection
