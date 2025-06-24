@extends('backend.layouts.app')

@section('title', __('Consultation Details'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            {{ __('Consultation'). ' - ' . $consultation->created_at->format('d M Y') }}
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('admin.consultation.index')" :text="__('Back')" />
        </x-slot>

        <x-slot name="body">
            <div class="">
                <div class="flex gap-10">
                    <div>
                        <strong>From:</strong> {{ $consultation->name }} <br>
                        <strong>Subject:</strong> {{ $consultation->subject }} <br>
                        <strong>Area:</strong> {{ $consultation->area }}
                    </div>
                    <div>
                        <strong>Email:</strong> {{ $consultation->email }} <br>
                        <strong>Phone:</strong> {{ $consultation->phone }}
                    </div>
                </div>
                <div>
                    <strong>Message:</strong><br>
                    {!! nl2br($consultation->message) !!}<br>
                </div>
            </div>
        </x-slot>
    </x-backend.card>
@endsection
