@extends('frontend.layouts.app')

@section('title', __('Home'))

@section('content')
    <div>
        <section class="relative">
            <div class="swiper home-banner-swiper h-60 md:h-[70vh]">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img class="object-cover w-full" src="https://swiperjs.com/demos/images/nature-1.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img class="object-cover w-full" src="https://swiperjs.com/demos/images/nature-2.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img class="object-cover w-full" src="https://swiperjs.com/demos/images/nature-3.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img class="object-cover w-full" src="https://swiperjs.com/demos/images/nature-4.jpg" />
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

            <div class="absolute inset-0 text-white">
                <div class="container flex items-center h-full">
                    <div class="md:w-3/4 lg:w-[40%] p-8 bg-black bg-opacity-50 md:ml-10 xl:ml-0 relative z-20">
                        <h3 class="text-3xl leading-none">Jasa Pembukuan & Laporan Akuntansi Keuangan</h3>
                        <div class="w-[15%] h-1.5 mt-4 bg-secondary"></div>
                        <p class="mt-7">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel odit ex totam ea quos ut, nobis consequatur deserunt modi dicta!</p>
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
                <span animate-slide-x class="flex items-center text-white text-nowrap">
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
                        class="relative flex items-center justify-center w-full overflow-hidden rounded-lg cursor-default aspect-square bg-[url('https://swiperjs.com/demos/images/nature-3.jpg')]">
                        <div x-show="!open" class="flex items-center justify-center w-full h-full p-6 bg-white/70"
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
                    <img class="aspect-[16/10]" src="https://swiperjs.com/demos/images/nature-3.jpg" alt="">
                </div>
                <div>
                    <div class="inline-block text-3xl font-semibold uppercase text-underline-left">Tentang kami</div>
                    <p class="mt-8">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Et dicta illo aut ad suscipit commodi quaerat id, rerum in quidem magni at minus a incidunt, obcaecati sit tenetur tempora odit iure cupiditate quis omnis. Itaque inventore voluptatem asperiores. Debitis sequi, voluptas aut minima quisquam consectetur velit rerum soluta minus doloremque, maxime laborum nesciunt totam. Voluptatem ab dolore voluptatum. Ipsum, commodi.</p>
                    <a href="" class="pl-4 pr-2 pt-1 pb-1.5 uppercase bg-secondary rounded-lg hover:bg-opacity-90 text-white text-nowrap inline-flex items-center mt-4">
                        <span>read more</span>
                        <i data-lucide="chevron-right"></i>
                    </a>
                </div>
            </div>
        </section>

        <section class="container grid grid-cols-2 gap-10 py-20">
            <div class="space-y-10">
                <div class="inline-block text-3xl font-semibold uppercase text-underline-left">Testimonials</div>
                <div class="swiper testimonial-swiper">
                    <div class="swiper-wrapper">
                        @for ($index = 0; $index < 5; $index++)
                            <div class="swiper-slide">
                                <div class="w-full p-6 font-light bg-gray-200 shadow bg-gra triangle">
                                    <p>"lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatibus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatibus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatibus."</p>
                                </div>
                                <div class="flex items-center gap-4 mt-4 ml-14">
                                    <div class="bg-gray-400 rounded-full size-28"></div>
                                    <div>
                                        <div class="text-lg font-semibold">Lorem Ipsum {{ $index }}</div>
                                        <div class="text-sm text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
            <div>
                <div class="inline-block text-3xl font-semibold uppercase text-underline-left">Our Certifications</div>

            </div>
        </section>
    </div>
@endsection
