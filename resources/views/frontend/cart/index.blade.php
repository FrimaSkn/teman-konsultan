@extends('frontend.layouts.app')

@section('title', __('Cart'))

@section('content')
    <div class="min-h-[calc(100vh-350px)]">
        <livewire:frontend.cart />
    </div>
@endsection
