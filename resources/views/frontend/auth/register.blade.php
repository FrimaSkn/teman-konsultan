@extends('frontend.layouts.app')

@section('title', __('Register'))

@section('content')
    <div class="container py-4 mx-auto">
        <div class="grid grid-cols-3">
            <div class="col-start-2">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Register')
                    </x-slot>

                    <x-slot name="body">
                        <x-forms.post :action="route('frontend.auth.register')">
                            <div class="grid-cols-3 grid">
                                <!-- Component: Plain basic input  -->
                                <div class="relative my-4 col-span-3">
                                    <input
                                        id="name"
                                        type="text"
                                        name="name"
                                        placeholder="{{ __('Name') }}"
                                        value="{{ old('name') }}"
                                        class="form-element peer" />
                                    <label for="name" class="form-label">
                                        @lang('Name')
                                    </label>
                                </div>

                            </div><!--form-group-->

                            <div class="grid-cols-3 grid">
                                <!-- Component: Plain basic input  -->
                                <div class="relative my-4 col-span-3">
                                    <input
                                        id="email"
                                        type="email"
                                        name="email"
                                        placeholder="{{ __('E-mail Address') }}"
                                        value="{{ old('email') }}"
                                        class="form-element" />
                                    <label for="email" class="form-label">
                                        @lang('E-mail Address')
                                    </label>
                                </div>

                            </div><!--form-group-->

                            <div class="grid-cols-3 grid">
                                <!-- Component: Plain basic input  -->
                                <div class="relative my-4 col-span-3">
                                    <input
                                        id="password"
                                        type="password"
                                        name="password"
                                        placeholder="{{ __('Password') }}"
                                        class="form-element" />
                                    <label for="password" class="form-label">
                                        @lang('Password')
                                    </label>
                                </div>
                            </div><!--form-group-->

                            <div class="grid-cols-3 grid">
                                <!-- Component: Plain basic input  -->
                                <div class="relative my-4 col-span-3">
                                    <input
                                        id="password_confirmation"
                                        type="password"
                                        name="password_confirmation"
                                        placeholder="{{ __('Password Confirmation') }}"
                                        class="form-element" />
                                    <label for="password_confirmation" class="form-label">
                                        @lang('Password Confirmation')
                                    </label>
                                </div>
                            </div><!--form-group-->

                            <div>
                                <!-- Component: Primary basic checkbox -->
                                <div class="relative flex flex-wrap items-center">
                                    <input
                                        class="w-4 h-4 transition-colors bg-white border-2 rounded appearance-none cursor-pointer focus-visible:outline-none peer border-slate-500 checked:border-emerald-500 checked:bg-emerald-500 checked:hover:border-emerald-600 checked:hover:bg-emerald-600 focus:outline-none checked:focus:border-emerald-700 checked:focus:bg-emerald-700 disabled:cursor-not-allowed disabled:border-slate-100 disabled:bg-slate-50"
                                        type="checkbox"
                                        id="terms"
                                        name="terms"
                                        value="1"
                                        required />
                                    <label class="pl-2 text-sm cursor-pointer text-slate-500 peer-disabled:cursor-not-allowed peer-disabled:text-slate-400" for="terms">
                                        @lang('I agree to the')
                                        <a class="underline"
                                            href="{{ route('frontend.pages.terms') }}" target="_blank">@lang('Terms & Conditions')</a>
                                    </label>
                                    <svg class="absolute left-0 w-4 h-4 transition-all duration-300 -rotate-90 opacity-0 pointer-events-none top-1 fill-white stroke-white peer-checked:rotate-0 peer-checked:opacity-100 peer-disabled:cursor-not-allowed" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" aria-labelledby="title-1 description-1" role="graphics-symbol">
                                        <title id="title-1">Check mark icon</title>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.8116 5.17568C12.9322 5.2882 13 5.44079 13 5.5999C13 5.759 12.9322 5.91159 12.8116 6.02412L7.66416 10.8243C7.5435 10.9368 7.37987 11 7.20925 11C7.03864 11 6.87501 10.9368 6.75435 10.8243L4.18062 8.42422C4.06341 8.31105 3.99856 8.15948 4.00002 8.00216C4.00149 7.84483 4.06916 7.69434 4.18846 7.58309C4.30775 7.47184 4.46913 7.40874 4.63784 7.40737C4.80655 7.406 4.96908 7.46648 5.09043 7.57578L7.20925 9.55167L11.9018 5.17568C12.0225 5.06319 12.1861 5 12.3567 5C12.5273 5 12.691 5.06319 12.8116 5.17568Z" />
                                    </svg>
                                </div>
                            </div><!--form-group-->

                            @if(config('boilerplate.access.captcha.registration'))
                                <div class="row">
                                    <div class="col">
                                        @captcha
                                        <input type="hidden" name="captcha_status" value="true" />
                                    </div><!--col-->
                                </div><!--row-->
                            @endif

                            <div class="grid grid-cols-3 gap-4 mt-4">
                                <div class="col-span-3">

                                    <x-frontend.basic.button
                                        :type="'primary'"
                                        :size="'md'"
                                        :label="__('Register')"
                                        class="w-full" />
                                </div>
                            </div><!--form-group-->
                        </x-forms.post>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--container-->
@endsection
