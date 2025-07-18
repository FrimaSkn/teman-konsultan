<footer class="bg-accent">
    <div class="container pt-10 pb-40 mx-auto">
        <div class="grid grid-cols-1 gap-8 lg:gap-1 xl:gap-8 lg:grid-cols-4">
            <div class="space-y-4">
                <div><img src="{{ asset('img/brand/logo.png') }}" alt="Teman Konsultan"></div>
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
                    <div>WhatsApp : <a href="https://wa.me/628978396600" target="_blank">+62 897-8396-600</a></div>
                </div>
                <div class="flex items-center gap-2 text-white">
                    <img class="w-5" src="{{ asset('img/icons/email.png') }}" alt="">
                    <div><a href="mailto:info@temankonsultan.com" target="_blank">info@temankonsultan.com</a></div>
                </div>
                <div class="flex items-center gap-2 text-white">
                    <img class="w-5" src="{{ asset('img/icons/call.png') }}" alt="">
                    <div>021 - 488 8888</div>
                </div>
                <div class="flex items-center gap-6 mt-6 max-lg:order-2">
                    <a href="https://www.instagram.com/temankonsultan/" target="_blank" rel="noopener noreferrer">
                        <img class="h-7" src="{{ asset('img/icons/ig.png') }}" alt="">
                    </a>
                    <a href="https://www.linkedin.com/company/temankonsultan" target="_blank" rel="noopener noreferrer">
                        <img class="h-7" src="{{ asset('img/icons/linkedin.png') }}" alt="">
                    </a>
                    <a href="https://www.facebook.com/profile.php?id=61576359022399 " target="_blank" rel="noopener noreferrer">
                        <img class="h-7" src="{{ asset('img/icons/fb.png') }}" alt="">
                    </a>
                    <a href="https://www.youtube.com/@teman.konsultan" target="_blank" rel="noopener noreferrer">
                        <img class="h-7" src="{{ asset('img/icons/yt.png') }}" alt="">
                    </a>
                    <a href="https://www.tiktok.com/@teman.konsultan" target="_blank" rel="noopener noreferrer">
                        <img class="h-7" src="{{ asset('img/icons/tiktok.png') }}" alt="">
                    </a>
                </div>
            </div>

            {{-- head office --}}
            <div class="leading-tight text-white max-lg:order-4">
                18 Parc Place, SCBD Tower B Lt. 2 <br>
                Jl. Jend. Sudirman Kav. 52-53 <br>
                Senayan, Kebayoran Baru <br>
                Jakarta Selatan 12190
            </div>

            {{-- WORKSHOP --}}
            <div class="leading-tight text-white max-lg:order-4">
                Latinos Business District BSD B16/6,
                Jl. Raya Rawa Buntu, Kel. Rawa Buntu, Kec. Serpong, Tangerang Selatan, Banten 15310
            </div>

            {{-- site map --}}
            <div class="grid gap-2 md:grid-flow-col md:grid-rows-4 max-lg:order-6">
                <div class="flex items-center gap-1 text-white uppercase group">
                    <i data-lucide="chevron-right" class="size-5 stroke-white group-hover:stroke-secondary"></i>
                    <a href="{{ route('frontend.home') }}" class="text-sm group-hover:text-secondary text-nowrap">Home</a>
                </div>
                <div class="flex items-center gap-1 text-white uppercase group">
                    <i data-lucide="chevron-right" class="size-5 stroke-white group-hover:stroke-secondary"></i>
                    <a href="#" class="text-sm group-hover:text-secondary text-nowrap">Jasa Kami</a>
                </div>
                <div class="flex items-center gap-1 text-white uppercase group">
                    <i data-lucide="chevron-right" class="size-5 stroke-white group-hover:stroke-secondary"></i>
                    <a href="{{ route('frontend.harga') }}" class="text-sm group-hover:text-secondary text-nowrap">Harga</a>
                </div>
                <div class="flex items-center gap-1 text-white uppercase group">
                    <i data-lucide="chevron-right" class="size-5 stroke-white group-hover:stroke-secondary"></i>
                    <a href="{{ route('frontend.post.index') }}" class="text-sm group-hover:text-secondary text-nowrap">Artikel</a>
                </div>
                <div class="flex items-center gap-1 text-white uppercase group">
                    <i data-lucide="chevron-right" class="size-5 stroke-white group-hover:stroke-secondary"></i>
                    <a href="{{ route('frontend.about') }}" class="text-sm group-hover:text-secondary text-nowrap">Tentang Kami</a>
                </div>
                <div class="flex items-center gap-1 text-white uppercase group">
                    <i data-lucide="chevron-right" class="size-5 stroke-white group-hover:stroke-secondary"></i>
                    <a href="{{ route('frontend.contact-us') }}" class="text-sm group-hover:text-secondary text-nowrap">Hubungi Kami</a>
                </div>
                <div class="flex items-center gap-1 text-white uppercase group">
                    <i data-lucide="chevron-right" class="size-5 stroke-white group-hover:stroke-secondary"></i>
                    <a href="{{ route('frontend.auth.free-consultation.index') }}" class="text-sm group-hover:text-secondary text-nowrap">free consultation</a>
                </div>
            </div>
        </div>
    </div>
</footer>
