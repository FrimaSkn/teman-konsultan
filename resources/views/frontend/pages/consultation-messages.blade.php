@extends('frontend.layouts.app')

@section('title', __('Consultation Message'))

@section('content')
    <x-frontend.hero-section :image="asset('img/asset-1.jpg')" />

    <section class="container py-20">
        <div class="text-xl font-semibold text-center uppercase md:text-3xl text-underline">TERIMA KASIH</div>

        <p class="pt-10 mx-auto text-center md:w-3/5"> kebutuhan konsultasi Anda telah terdaftar. Anda akan dihubungi untuk schedule konsultasi.</p>
    </section>
@endsection
