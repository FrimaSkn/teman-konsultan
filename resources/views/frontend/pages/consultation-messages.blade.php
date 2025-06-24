@extends('frontend.layouts.app')

@section('title', __('Consultation Message'))

@section('content')
    <x-frontend.hero-section :image="asset('img/bg-hero-1.jpg')" />

    <section class="container py-20">
        <div class="text-3xl font-semibold text-center uppercase text-underline">TERIMA KASIH</div>

        <p class="w-3/5 pt-10 mx-auto text-center"> kebutuhan konsultasi Anda telah terdaftar. Anda akan dihubungi untuk schedule konsultasi.</p>
    </section>
@endsection
