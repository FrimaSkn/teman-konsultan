@extends('frontend.layouts.app')

@section('title', __('Home'))

@section('content')
    <div>
        <section class="relative">
            <div class="swiper home-banner-swiper h-60 md:h-[70vh]">
                <div class="swiper-wrapper">
                    @for ($i = 1; $i <= 5; $i++)
                        <div class="swiper-slide">
                            <img class="object-cover w-full" src="{{ asset('img/asset-' . $i . '.jpg') }}" />
                        </div>
                    @endfor
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

            <div class="absolute inset-0 text-white">
                <div class="container flex items-center h-full">
                    <div class="md:w-3/4 lg:w-[45%] p-8 bg-black bg-opacity-50 md:ml-10 xl:ml-0 relative z-20">
                        <h3 class="text-3xl leading-none">One Stop Solutions for Your Business</h3>
                        <div class="w-[15%] h-1.5 mt-4 bg-secondary"></div>
                        <p class="mt-7">Kami menyediakan Solusi Satu Pintu yang Terintegrasi dengan personel berkualifikasi tinggi dalam bidang keuangan, perpajakan, akuntansi, penggajian, hukum, teknologi, konsultasi dan audit; meningkatkan dukungan secara efektif untuk pengembangan bisnis Anda. </p>
                        <a href="" class="pl-4 pr-2 pt-1 pb-1.5 uppercase bg-secondary rounded-lg hover:bg-opacity-90 text-primary font-bold text-nowrap inline-flex items-center mt-4">
                            <span>read more</span>
                            <i data-lucide="chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <div class="container flex items-center justify-between px-16 py-6 text-white bg-primary">
            <h2>PERCAYAKAN KENUTUHAN PERPAJAKAN DAN AKUNTING PERUSAHAAN ANDA KEPADA KAMI</h2>
            <a href="" data-motion="hover-btn" class="pl-4 pr-2 pt-1 pb-1.5 uppercase bg-secondary rounded-lg overflow-hidden">
                <span animate-slide-x class="flex items-center font-medium text-primary text-nowrap">
                    <span>get a quote</span>
                    <i data-lucide="chevron-right"></i>
                </span>
            </a>
        </div>

        <section class="container flex flex-col items-center justify-center pt-10 pb-20 space-y-10">
            <h2 class="block text-3xl font-semibold text-underline">JASA KAMI</h2>

            <div class="grid w-full grid-cols-2 gap-4 md:grid-cols-4">
                @foreach ($services as $category)
                    <div x-data="{ open: false }" x-on:mouseenter="open = true" x-on:mouseleave="open = false" data-motion="hover-stg"
                        class="relative flex items-center justify-center w-full overflow-hidden bg-cover rounded-lg shadow cursor-default aspect-square" style="background-image: url('{{ $category->getFirstMediaUrl('service_category') }}');">
                        <div x-show="!open" class="flex items-center justify-center w-full h-full p-6 bg-white/60"
                            x-transition:enter="transition ease-in duration-200"
                            x-transition:enter-start="opacity-10 translate-y-20"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-out duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-20">
                            <div class="text-center uppercase md:text-2xl lg:text-[1.7rem]">{{ $category->name }}</div>
                        </div>
                        <div x-show="open" class="absolute top-0 left-0 w-full h-full p-4 text-white rounded-lg bg-primary/85"
                            x-transition:enter="transition ease-in duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-20"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-out duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-20"
                        >
                            <div class="relative items-center justify-center w-full h-full max-md:flex">
                                <div class="flex items-center w-full h-4/5 max-md:hidden">
                                    <ol class="text-sm list-disc list-inside">
                                        @foreach ($category->services as $service)
                                            <li animate-fade-right>{{ $service->name }}</li>
                                        @endforeach
                                    </ol>
                                </div>
                                <a href="" class="pl-3 pr-1 py-0.5 uppercase text-sm bg-secondary rounded-lg hover:bg-opacity-90 text-white text-nowrap inline-flex items-center justify-between">
                                    <div>see detail</div>
                                    <i data-lucide="chevron-right" class="justify-self-end"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="py-20 bg-gray-200">
            <div class="container grid grid-cols-2 gap-10">
                <div>
                    <img class="aspect-[16/10]" src="{{ asset('img/thumb-1.jpg') }}" alt="">
                </div>
                <div>
                    <div class="inline-block text-3xl font-semibold uppercase text-underline-left">Tentang kami</div>
                    <p class="mt-8">
                        Berlandaskan harapan yang tulus untuk mendukung perkembangan bisnis dan mempermudah pekerjaan pemilik bisnis serta manajemen atas, kami menawarkan solusi terintegrasi satu pintu di bidang bidang keuangan, perpajakan, akuntansi, penggajian, hukum, teknologi, konsultasi dan audit. Didukung oleh tim professional kami, kami memastikan semua pekerjaan kami dilakukan dengan standar tertinggi berdasarkan nilai-nilai profesionalisme, tanggung jawab dan integritas.
                    </p>
                    <a href="" class="pl-4 pr-2 pt-1 pb-1.5 uppercase bg-secondary rounded-lg hover:bg-opacity-90 text-white text-nowrap inline-flex items-center mt-4">
                        <span>read more</span>
                        <i data-lucide="chevron-right"></i>
                    </a>
                </div>
            </div>
        </section>

        <section class="container py-20">
            <h2 class="inline-block text-3xl font-semibold uppercase text-underline-left">why choose us?</h2>
            <div class="grid grid-cols-3 gap-8 mt-10">
                <div>
                    <div class="h-24 aspect-[9/12] mb-3">
                        <img class="object-contain object-bottom h-full" src="{{ asset('img/icons/Asset-1.png') }}" alt="">
                    </div>
                    <div class="text-xl font-bold text-primary">Solusi Terintegrasi Satu Pintu</div>
                    <p>Kami menyediakan solusi komprehensif yang mencakup keseluruhan bidang, membuat koordinasi lebih mudah dan Anda dapat memanfaatkan waktu yang berharga untuk kemajuan bisnis.</p>
                </div>
                <div>
                    <div class="h-24 aspect-[9/12] mb-3">
                        <img class="object-contain object-bottom h-full" src="{{ asset('img/icons/Asset-2.png') }}" alt="">
                    </div>
                    <div class="text-xl font-bold text-primary">Profesional dan Berpengalaman</div>
                    <p>Kami memiliki keahlian di bidang akuntansi, keuangan, pajak dan lainnya serta berpengalaman lebih dari 10 tahun.</p>
                </div>
                <div>
                    <div class="h-24 aspect-[9/12] mb-3">
                        <img class="object-contain object-bottom h-full" src="{{ asset('img/icons/Asset-3.png') }}" alt="">
                    </div>
                    <div class="text-xl font-bold text-primary">Berkomitmen</div>
                    <p>Kami memiliki komitmen tinggi di setiap penugasan kami</p>
                </div>
                <div>
                    <div class="h-24 aspect-[9/12] mb-3">
                        <img class="object-contain object-bottom h-full" src="{{ asset('img/icons/Asset-4.png') }}" alt="">
                    </div>
                    <div class="text-xl font-bold text-primary">Komunikatif dan Responsif</div>
                    <p>Kami berkomunikasi rutin dengan Anda untuk memberikan update atas proses pengerjaan serta selalu responsif atas pertanyaan Anda.</p>
                </div>
                <div>
                    <div class="h-24 aspect-[9/12] mb-3">
                        <img class="object-contain object-bottom h-full" src="{{ asset('img/icons/Asset-5.png') }}" alt="">
                    </div>
                    <div class="text-xl font-bold text-primary">Menjaga kerahasiaan</div>
                    <p>Keamanan data Anda merupakan prioritas utama kami. Kami menjamin kerahasiaan data yang Anda berikan</p>
                </div>
                <div>
                    <div class="h-24 aspect-[9/12] mb-3">
                        <img class="object-contain object-bottom h-full" src="{{ asset('img/icons/Asset-6.png') }}" alt="">
                    </div>
                    <div class="text-xl font-bold text-primary">Tetap terhubung</div>
                    <p>Kami aktif membagikan berita dan artikel tentang standar dan peraturan baru yang relevan kepada klien kami untuk tetap update.</p>
                </div>
            </div>
        </section>

        <section class="w-full bg-top bg-no-repeat bg-cover bg_filter" style="background-image: url('{{ asset('img/bg-section-100.jpg') }}')">
            <div class="container relative py-40 z-[2]">
                <p class="inline-block text-xl text-white text-underline-left">Kami terus berkembang untuk menginspirasi para pemilik bisnis <br> agar belajar dan mengelola pekerjaan pajak dan akuntansi mereka.</p>
                <div class="flex items-center gap-10 mt-10">
                    <div class="text-white">
                        <div class="text-3xl font-light">IDR 81 MILYAR</div>
                        <div class="text-xs font-light">TOTAL UANG YANG KAMI ATUR</div>
                    </div>
                    <div class="text-white">
                        <div class="flex items-center gap-2 text-3xl font-light">
                            <img src="{{ asset('img/icons/Asset-7.png') }}" alt="">
                            <span>1,741</span>
                        </div>
                        <div class="text-xs font-light">PAJAK & AKUNTING TERLAKSANA</div>
                    </div>
                    <div class="text-white">
                        <div class="flex items-center gap-2 text-3xl font-light">
                            <img src="{{ asset('img/icons/Asset-8.png') }}" alt="">
                            <span>156</span>
                        </div>
                        <div class="text-xs font-light">KLIEN PUAS</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container py-20">
            <div class="inline-block text-3xl font-semibold uppercase text-underline-left">Article</div>

            <div class="grid grid-cols-3 gap-4 mt-10">
                @for ($i = 0; $i < 3; $i++)
                <div>
                    <div class="bg-center bg-cover aspect-video" style="background-image: url('{{ asset('img/thumb-1.jpg') }}"></div>
                    <div class="text-lg font-medium">Title</div>
                    <div class="text-sm text-gray-300">Author | Date</div>
                    <p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor.</p>
                    <a href="" class="pl-4 pr-2 pt-1 pb-1.5 uppercase bg-secondary rounded-lg hover:bg-opacity-90 text-white text-nowrap inline-flex items-center mt-4">
                        <span>read more</span>
                        <i data-lucide="chevron-right"></i>
                    </a>
                </div>
                @endfor
            </div>
        </section>
    </div>
@endsection
