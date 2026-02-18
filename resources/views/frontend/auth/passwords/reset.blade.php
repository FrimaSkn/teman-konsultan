@extends('frontend.layouts.app')

@section('title', __('Reset Password'))

@section('content')
    <x-frontend.hero-section />

    <div class="container py-4 mx-auto">
        <div class="grid grid-cols-3">
            <div class="col-start-2">
                <x-frontend.card>
                    <x-slot name="header">
                         <div class="text-xl font-medium text-center uppercase md:text-2xl text-underline">
                            @lang('Reset Password')
                        </div>
                    </x-slot>

                    <x-slot name="body">
                         @if(isset($errors) && $errors->any())
                            <x-utils.alert type="danger">
                                @foreach($errors->all() as $error)
                                    {{ $error }}<br/>
                                @endforeach
                            </x-utils.alert>
                        @endif

                        <x-forms.post :action="route('frontend.auth.password.update')">
                            <input type="hidden" name="token" value="{{ $token }}" />

                            <div class="grid grid-cols-3">
                                <div class="relative col-span-3 my-3">
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">@lang('E-mail Address')</label>
                                    <input type="email" id="email" name="email" class="shadow-xs bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-3">
                                <div class="relative col-span-3 my-3">
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 uppercase">@lang("Password")</label>
                                    <input type="password" id="password" name="password" class="shadow-xs bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-3">
                                <div class="relative col-span-3 my-3">
                                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 uppercase">@lang("Password Confirmation")</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="shadow-xs bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                                </div>
                            </div>

                            <button class="pl-8 pr-6 pt-1 pb-1.5 uppercase bg-secondary rounded-lg hover:bg-opacity-90 text-primary font-bold text-nowrap inline-flex items-center" type="submit">
                                <span>@lang('Reset Password')</span>
                                <i data-lucide="chevron-right"></i>
                            </button>
                        </x-forms.post>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--container-->
@endsection
