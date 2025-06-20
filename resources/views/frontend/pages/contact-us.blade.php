@extends('frontend.layouts.app')

@section('title', __('Hubungi Kami'))

@section('content')
    <x-frontend.hero-section :image="asset('img/bg-hero-1.jpg')" />
    <section class="container pt-20">
        <div class="text-3xl font-semibold text-center uppercase text-underline">HUBUNGI KAMI</div>

        <div class="grid grid-cols-2 mt-10">
            <div class="w-full aspect-video"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2610539142584!2d106.81034819999999!3d-6.229273999999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f19c6e35b28f%3A0x748573069d39f637!2s18%20Parc%20Place%20SCBD!5e0!3m2!1sen!2sid!4v1750056022337!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
            <div class="w-full p-8 bg-primary aspect-video">
                <div class="text-xl font-semibold text-white uppercase text-underline-left">head office</div>
                <div class="pt-8 font-light text-white">18 Parc Place, SCBD Tower B Lt. 2 <br>
                    Jl. Jend. Sudirman Kav. 52-53 <br>
                    Senayan, Kebayoran Baru <br>
                    Jakarta Selatan 12190
                </div>
            </div>
            <div class="w-full p-8 bg-secondary aspect-video">
                <div class="text-xl font-semibold uppercase text-primary text-underline-left-blue">head office</div>
                <div class="pt-8 font-light text-primary">
                    Latinos Business District BSD B16/6, <br>
                    Jl. Raya Rawa Buntu, Kel. Rawa Buntu, <br>
                    Kec. Serpong, Tangerang Selatan, Banten 15310 <br>
                </div>
            </div>
            <div class="w-full aspect-video"><iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3965.561787214481!2d106.67920117586915!3d-6.321144361856625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s%20Latinos%20Business%20District%20BSD%20B16%2F6%2C%20%20Jl.%20Raya%20Rawa%20Buntu%2C%20Kel.%20Rawa%20Buntu%2C%20%20Kec.%20Serpong%2C%20Tangerang%20Selatan%2C%20Banten%2015310!5e0!3m2!1sen!2sid!4v1750056268556!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
        </div>
        <div class="grid grid-cols-3 mt-6">
            <div class="flex items-center justify-center gap-2">
                <img class="w-5" src="{{ asset('img/icons/wa.png') }}" alt="">
                <div>WhatsApp : <a href="#">+62812 3456 789</a></div>
            </div>
            <div class="flex items-center justify-center gap-2">
                <img class="w-5" src="{{ asset('img/icons/email.png') }}" alt="">
                <div><a href="#">info@temankonsultan.com</a></div>
            </div>
            <div class="flex items-center justify-center gap-2">
                <img class="w-5" src="{{ asset('img/icons/call.png') }}" alt="">
                <div>021 - 488 8888</div>
            </div>
        </div>

        <div class="grid grid-cols-11 mt-20">
            <div class="self-end col-span-5">
                <img src="{{ asset('img/asset-contact.png') }}" alt="">
            </div>
            <div class="col-span-6">
                <div class="text-xl font-semibold uppercase text-underline-left">ENQUIRY FORM</div>

                <form action="#" class="my-20">
                    <div class="grid grid-cols-3">
                        <div class="relative col-span-3 my-3">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 uppercase">Nama lengkap</label>
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
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 uppercase">NOMOR WHATSAPP / HP</label>
                            <input type="text" id="phone" name="phone" class="shadow-xs bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="" required />
                        </div>
                    </div>
                    <div class="grid grid-cols-3">
                        <div class="relative col-span-3 my-3">
                            <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 uppercase">Subject</label>
                            <input type="text" id="subject" name="subject" class="shadow-xs bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="" required />
                        </div>
                    </div>
                    <div class="grid grid-cols-3">
                        <div class="relative col-span-3 my-3">
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 uppercase">pesan</label>
                            <textarea id="message" name="message" rows="6" class="shadow-xs bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="" required ></textarea>
                        </div>
                    </div>

                    <button class="pl-8 pr-6 pt-1 pb-1.5 uppercase bg-secondary float-right rounded-lg hover:bg-opacity-90 text-primary font-bold text-nowrap inline-flex items-center" type="submit">
                        <span>@lang('Submit')</span>
                        <i data-lucide="chevron-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
