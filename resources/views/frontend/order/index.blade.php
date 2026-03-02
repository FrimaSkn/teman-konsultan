@extends('frontend.layouts.app')

@section('title', __('Checkout'))

@section('content')
    <div class="min-h-[calc(100vh-350px)]">
        <livewire:frontend.oder-store  :order="$order"/>
    </div>
@endsection
