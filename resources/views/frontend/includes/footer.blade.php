<footer class="bg-accent">
    <div class="container pt-10 pb-40 mx-auto">
        <div class="grid grid-cols-1 gap-8 lg:gap-1 xl:gap-8 lg:grid-cols-4">
            <div class="space-y-4">
                <div><img class="h-12 md:h-20" src="{{ asset('img/brand/logo.png') }}" alt="Teman Konsultan"></div>
                <div class="w-1/6 h-1 bg-secondary"></div>
            </div>
            <div class="self-end space-y-6 max-lg:order-3">
                <div class="text-xl font-light leading-none text-white">HEAD OFFICE</div>
                <div class="w-1/6 h-1 bg-secondary"></div>
            </div>
            <div class="self-end space-y-6 max-lg:order-3">
                <div class="text-xl font-light leading-none text-white">WORKSHOP</div>
                <div class="w-1/6 h-1 bg-secondary"></div>
            </div>
            <div class="self-end space-y-6 max-lg:order-5">
                <div class="text-xl font-light leading-none text-white">SITE MAP</div>
                <div class="w-1/6 h-1 bg-secondary"></div>
            </div>

            {{-- Logo --}}
            <div>
                <div class="flex items-center gap-2 text-white">
                    <img class="w-5" src="{{ asset('img/icons/wa.png') }}" alt="">
                    <div>WhatsApp : <a href="https://wa.me/{{ $generalSettings->whatsapp }}" target="_blank">{{ mask_wa($generalSettings->whatsapp) }}</a></div>
                </div>
                <div class="flex items-center gap-2 text-white">
                    <img class="w-5" src="{{ asset('img/icons/email.png') }}" alt="">
                    <div><a href="mailto:{{ $generalSettings->email }}" target="_blank">{{ $generalSettings->email }}</a></div>
                </div>
                <div class="flex items-center gap-2 text-white">
                    <img class="w-5" src="{{ asset('img/icons/call.png') }}" alt="">
                    <div>{{ mask_phone($generalSettings->phone) }}</div>
                </div>
                <div class="flex flex-wrap items-center gap-6 mt-6 max-lg:order-2">
                    @foreach ($generalSettings->social_media as $sosmed)
                        <a href="{{ $sosmed['link'] }}" target="_blank" rel="noopener noreferrer">
                            <img class="h-7" src="{{ asset('/storage/pages/' . $sosmed['icon']) }}" alt="">
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- head office --}}
            <div class="leading-tight text-white max-lg:order-4">
                {!! nl2br($generalSettings->addrs_head_office) !!}
            </div>

            {{-- WORKSHOP --}}
            <div class="leading-tight text-white max-lg:order-4">
                {!! nl2br($generalSettings->addrs_workshop) !!}
            </div>

            {{-- site map --}}
            <div class="grid gap-2 md:grid-flow-col md:grid-rows-4 max-lg:order-6">
                <div class="flex items-center gap-1 text-white uppercase group">
                    <i data-lucide="chevron-right" class="size-5 stroke-white group-hover:stroke-secondary"></i>
                    <a href="{{ route('frontend.home') }}" class="text-sm group-hover:text-secondary text-nowrap">@lang('Home')</a>
                </div>
                <div class="flex items-center gap-1 text-white uppercase group">
                    <i data-lucide="chevron-right" class="size-5 stroke-white group-hover:stroke-secondary"></i>
                    <a href="#" class="text-sm group-hover:text-secondary text-nowrap">@lang('Our Services')</a>
                </div>
                <div class="flex items-center gap-1 text-white uppercase group">
                    <i data-lucide="chevron-right" class="size-5 stroke-white group-hover:stroke-secondary"></i>
                    <a href="{{ route('frontend.harga') }}" class="text-sm group-hover:text-secondary text-nowrap">@lang('Pricing')</a>
                </div>
                <div class="flex items-center gap-1 text-white uppercase group">
                    <i data-lucide="chevron-right" class="size-5 stroke-white group-hover:stroke-secondary"></i>
                    <a href="{{ route('frontend.post.index') }}" class="text-sm group-hover:text-secondary text-nowrap">@lang('Article')</a>
                </div>
                <div class="flex items-center gap-1 text-white uppercase group">
                    <i data-lucide="chevron-right" class="size-5 stroke-white group-hover:stroke-secondary"></i>
                    <a href="{{ route('frontend.about') }}" class="text-sm group-hover:text-secondary text-nowrap">@lang('About Us')</a>
                </div>
                <div class="flex items-center gap-1 text-white uppercase group">
                    <i data-lucide="chevron-right" class="size-5 stroke-white group-hover:stroke-secondary"></i>
                    <a href="{{ route('frontend.contact-us') }}" class="text-sm group-hover:text-secondary text-nowrap">@lang('Contact Us')</a>
                </div>
                <div class="flex items-center gap-1 text-white uppercase group">
                    <i data-lucide="chevron-right" class="size-5 stroke-white group-hover:stroke-secondary"></i>
                    <a href="{{ route('frontend.auth.free-consultation.index') }}" class="text-sm group-hover:text-secondary text-nowrap">free consultation</a>
                </div>
            </div>
        </div>
    </div>
</footer>
