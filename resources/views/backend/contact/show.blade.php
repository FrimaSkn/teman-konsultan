@extends('backend.layouts.app')

@section('title', __('Contact Us'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            {{ __('Contact'). ' - ' . $contact->created_at->format('d M Y') }}
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('admin.contact.index')" :text="__('Back')" />
        </x-slot>

        <x-slot name="body">
            <div class="">
                <div class="flex gap-10">
                    <div>
                        <strong>From:</strong> {{ $contact->name }} <br>
                        <strong>Subject:</strong> {{ $contact->subject }}
                    </div>
                    <div>
                        <strong>Email:</strong> {{ $contact->email }} <br>
                        <strong>Phone:</strong> {{ $contact->phone }}
                    </div>
                </div>
                <div>
                    <strong>Message:</strong><br>
                    {!! nl2br($contact->message) !!}<br>
                </div>
            </div>
        </x-slot>
    </x-backend.card>
@endsection
