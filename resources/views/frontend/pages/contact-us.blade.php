@extends('frontend.layouts.app')

@section('title', __('Hubungi Kami'))

@section('content')
    <x-frontend.hero-section :image="'/storage/pages/'.$settings->banner_contact" />
    <section class="container pt-20">
        <div class="text-xl font-semibold text-center uppercase md:text-3xl text-underline" data-motion="inview-fadedown" data-animate>@lang('Contact Us')</div>

        <div class="grid mt-10 md:grid-cols-2">
            <div class="w-full max-md:order-2 aspect-square md:aspect-video" data-motion="inview-downright" data-animate>
                {!! $generalSettings->gmap_head_office !!}
            </div>
            <div class="w-full p-8 max-md:order-1 bg-primary md:aspect-video" data-motion="inview-downleft" data-animate>
                <div class="text-xl font-semibold text-white uppercase text-underline-left">head office</div>
                <div class="pt-8 font-light text-white">
                    {!! nl2br($generalSettings->addrs_head_office) !!}
                </div>
            </div>
            <div class="w-full p-8 bg-secondary md:aspect-video max-md:order-3" data-motion="inview-upright" data-animate>
                <div class="text-xl font-semibold uppercase text-primary text-underline-left-blue">WORKSHOP</div>
                <div class="pt-8 font-light text-primary">
                    {!! nl2br($generalSettings->addrs_workshop) !!}
                </div>
            </div>
            <div class="w-full aspect-square md:aspect-video max-md:order-4" data-motion="inview-upleft" data-animate>
                {!! $generalSettings->gmap_workshop !!}
            </div>
        </div>
        <div class="grid mt-6 md:grid-cols-3 max-lg:text-sm">
            <div class="flex items-center gap-2 md:justify-center">
                <img class="w-5" src="{{ asset('img/icons/wa.png') }}" alt="">
                <div>WhatsApp : <a href="https://wa.me/{{ $generalSettings->whatsapp }}" target="_blank">{{ mask_wa($generalSettings->whatsapp) }}</a></div>
            </div>
            <div class="flex items-center gap-2 md:justify-center">
                <img class="w-5" src="{{ asset('img/icons/email.png') }}" alt="">
                <div><a href="mailto:{{ $generalSettings->email }}" target="_blank">{{ $generalSettings->email }}</a></div>
            </div>
            <div class="flex items-center gap-2 md:justify-center">
                <img class="w-5" src="{{ asset('img/icons/call.png') }}" alt="">
                <div>{{ mask_phone($generalSettings->phone) }}</div>
            </div>
        </div>

        <div id="form-contact" class="grid pt-10 md:pt-20 md:grid-cols-11">
            <div class="self-end col-span-5">
                <img src="{{ asset('img/asset-contact.png') }}" alt="">
            </div>
            <div class="col-span-6" data-motion="inview-fadeup" data-animate>
                <div class="text-xl font-semibold uppercase text-underline-left">ENQUIRY FORM</div>

                <x-forms.post :action="route('frontend.contact-us.store')" class="my-14 md:my-20">
                    <div class="grid grid-cols-3">
                        <div class="relative col-span-3 my-3">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 uppercase">@lang('Full Name')</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="shadow-xs bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                {{ $errors->has('name') ? 'border-red-500' : 'border-gray-600' }}"
                                placeholder=""  required/>
                        </div>
                        @error('name')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="grid grid-cols-3">
                        <div class="relative col-span-3 my-3">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 uppercase">@lang('Email')</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="shadow-xs bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                {{ $errors->has('email') ? 'border-red-500' : 'border-gray-600' }}"
                                placeholder="" required />
                        </div>
                        @error('email')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="grid grid-cols-3">
                        <div class="relative col-span-3 my-3">
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 uppercase">@lang('Whatsapp Number / HP')</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                class="shadow-xs bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                {{ $errors->has('phone') ? 'border-red-500' : 'border-gray-600' }}"
                                placeholder="" required />
                        </div>
                        @error('phone')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="grid grid-cols-3">
                        <div class="relative col-span-3 my-3">
                            <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 uppercase">@lang('Subject')</label>
                            <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                                class="shadow-xs bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                {{ $errors->has('subject') ? 'border-red-500' : 'border-gray-600' }}"
                                placeholder="" required />
                        </div>
                        @error('subject')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="grid grid-cols-3">
                        <div class="relative col-span-3 my-3">
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 uppercase">@lang('Message')</label>
                            <textarea id="message" name="message" rows="6"
                            class="shadow-xs bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                            {{ $errors->has('message') ? 'border-red-500' : 'border-gray-600' }}"
                            placeholder="" required >{{ old('message') }}</textarea>
                        </div>
                        @error('message')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    @if(config('boilerplate.access.captcha.registration'))
                        <div class="init-captcha">
                            @captcha
                            <input type="hidden" name="captcha_status" value="true" />
                        </div><!--col-->
                    @endif

                    @error('g-recaptcha-response')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror

                    <button class="pl-8 pr-6 pt-1 pb-1.5 uppercase bg-secondary float-right rounded-lg hover:bg-opacity-90 text-primary font-bold text-nowrap inline-flex items-center" type="submit">
                        <span>@lang('Submit')</span>
                        <i data-lucide="chevron-right"></i>
                    </button>
                </x-forms.post>
            </div>
        </div>
    </section>
@endsection
