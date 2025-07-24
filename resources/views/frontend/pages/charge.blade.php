@extends('frontend.layouts.app')

@section('title', __('Harga'))

@section('content')
    <section class="py-20 bg-[#e7e8ea]">
        <div class="container">
            <h2 class="block text-3xl font-bold text-center uppercase text-underline text-primary">Harga</h2>
            <p class="pt-10 mx-auto text-center lg:w-3/5 max-md:text-sm">Berikut adalah Harga Paket Pupular kami, terutama untuk Perusahaan Start up dan UMKM. Untuk pertanyaan lebih lanjut, ataupun jasa lainnya, konsultasikan langsung ke kami.</p>
        </div>

        <div x-data="{ tab: '{{ $categories->first()->slug }}' }" class="space-y-10">
            <div class="flex flex-wrap justify-center gap-4 pt-10">
                @foreach ($categories as $category)
                    <button x-on:click="tab = '{{ $category->slug }}'" class="max-md:w-full pricelist-tabs" x-bind:class="{'active': tab == '{{ $category->slug }}'}">{{ $category->name }}</button>
                @endforeach
            </div>

            @foreach ($categories as $category)
                @if ($category->layout == 'slider')
                    <div x-cloak x-show="tab === '{{ $category->slug }}'" class=""><x-frontend.charge.slider :data="$packages" categorySlug="{{ $category->slug }}"/></div>
                @endif

                @if ($category->layout == 'default')
                    <div x-cloak x-show="tab === '{{ $category->slug }}'" class="text-center"><x-frontend.charge.default :data="$packages" categorySlug="{{ $category->slug }}"/></div>
                @endif
            @endforeach
            {{-- <div x-cloak x-show="tab === 'tab1'" class=""><x-frontend.charge.slider :data="$packages" categorySlug="akuntansi-perpajakan"/></div>
            <div x-cloak x-show="tab === 'tab2'" class="text-center"><x-frontend.charge.default :data="$packages" categorySlug="akuntansi"/></div>
            <div x-cloak x-show="tab === 'tab3'" class="text-center"><x-frontend.charge.default :data="config('web-data.charges.perpajakan_individual')"/></div>
            <div x-cloak x-show="tab === 'tab4'" class="text-center"><x-frontend.charge.default :data="config('web-data.charges.perpajakan_perusahaan')"/></div>
            <div x-cloak x-show="tab === 'tab5'" class="text-center"><x-frontend.charge.default :data="config('web-data.charges.virtual_manager')"/></div>
            <div x-cloak x-show="tab === 'tab6'"><x-frontend.charge.slider :data="$packages" categorySlug="konsultasi" /></div> --}}
        </div>
    </section>
@endsection
