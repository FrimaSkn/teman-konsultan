@extends('frontend.layouts.app')

@section('title', __('Verify Your E-mail Address'))

@section('content')
    <div class="container py-4 mx-auto min-h-[calc(100vh-450px)] flex items-center justify-center">
        <div class="max-w-xl mx-auto overflow-hidden bg-white rounded-lg shadow-md">
            <!-- Card Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h2 class="text-xl font-semibold text-gray-800">@lang('Verify Your E-mail Address')</h2>
            </div>

            <!-- Card Body -->
            <div class="p-6">
                <p class="text-gray-700">
                    @lang('Before proceeding, please check your email for a verification link.')
                    @lang('If you did not receive the email')
                </p>

                <x-forms.post :action="route('frontend.auth.verification.resend')" class="d-inline">
                    <button class="pl-4 pr-2 pt-1 pb-1.5 bg-primary uppercase rounded-lg hover:bg-opacity-90 text-secondary font-bold text-nowrap inline-flex items-center mt-2 max-md:text-sm md:mt-4" type="submit">@lang('click here to request another')</button>
                </x-forms.post>
            </div>
        </div>
        {{-- <div class="grid grid-cols-3">
            <div class="col-start-2">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Verify Your E-mail Address')
                    </x-slot>

                    <x-slot name="body">
                        @lang('Before proceeding, please check your email for a verification link.')
                        @lang('If you did not receive the email')

                        <x-forms.post :action="route('frontend.auth.verification.resend')" class="d-inline">
                            <button class="p-0 m-0 align-baseline btn btn-link" type="submit">@lang('click here to request another').</button>
                        </x-forms.post>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-8-->
        </div><!--row--> --}}
    </div><!--container-->
@endsection
