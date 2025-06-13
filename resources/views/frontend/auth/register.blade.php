@extends('frontend.layouts.app')

@section('title', __('Register'))

@section('content')
    <x-frontend.hero-section />
    <div class="container mx-auto min-h-[40svh] py-10 flex items-center justify-center">
        <div class="w-full max-w-lg">
                <x-frontend.card>
                    <x-slot name="header">
                        <div class="mb-5 text-2xl font-medium text-center uppercase text-underline">
                            @lang('Register')
                        </div>
                    </x-slot>

                    <x-slot name="body">
                        <x-forms.post :action="route('frontend.auth.register')">
                            <div class="grid grid-cols-3">
                                <div class="relative col-span-3 my-3">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 uppercase">nama lengkap</label>
                                    <input type="text" id="name" name="name" class="shadow-xs bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-3">
                                <div class="relative col-span-3 my-3">
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 uppercase">EMAIL</label>
                                    <input type="email" id="email" name="email" class="shadow-xs bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-3">
                                <div class="relative col-span-3 my-3">
                                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 uppercase">nomor whatsapp / hp</label>
                                    <input type="text" id="phone" name="phone" class="shadow-xs bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-3">
                                <div class="relative col-span-3 my-3">
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 uppercase">password</label>
                                    <input type="password" id="password" name="password" class="shadow-xs bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-3">
                                <div class="relative col-span-3 my-3">
                                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 uppercase">retype password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="shadow-xs bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                                </div>
                            </div>

                            @if(config('boilerplate.access.captcha.registration'))
                                <div class="row">
                                    <div class="col">
                                        @captcha
                                        <input type="hidden" name="captcha_status" value="true" />
                                    </div><!--col-->
                                </div><!--row-->
                            @endif

                            <div class="float-right mt-3">
                                <button class="pl-8 pr-6 pt-1 pb-1.5 uppercase bg-secondary rounded-lg hover:bg-opacity-90 text-primary font-bold text-nowrap inline-flex items-center" type="submit">
                                    <span>@lang('Create Account')</span>
                                    <i data-lucide="chevron-right"></i>
                                </button>
                            </div>
                        </x-forms.post>
                    </x-slot>
                </x-frontend.card>
        </div><!--row-->
    </div><!--container-->
@endsection
