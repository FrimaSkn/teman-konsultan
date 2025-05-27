@extends('frontend.layouts.app')

@section('title', __('Harga'))

@section('content')
    <section class="py-20 bg-[#e7e8ea]">
        <div class="container">
            <h2 class="block text-3xl font-bold text-center uppercase text-underline text-primary">Harga</h2>
            <p class="w-3/5 pt-10 mx-auto text-center">Berikut adalah Harga Paket Pupular kami, terutama untuk Perusahaan Star Up dan UMKM. Untuk pertanyaan lebih lanjut, ataupun jasa lainnya, konsultasikan langsung ke kami.</p>
        </div>

        <div x-data="{ tab: 'tab1' }" class="space-y-10">
            <div class="flex justify-center gap-4 pt-10">
                <button x-on:click="tab = 'tab1'" class="px-6 py-1.5 leading-tight text-white uppercase rounded-lg bg-primary max-w-40">Akutansi & Perpajakan</button>
                <button x-on:click="tab = 'tab2'" class="px-6 py-1.5 leading-tight text-white uppercase rounded-lg bg-primary max-w-40">Akutansi</button>
                <button x-on:click="tab = 'tab3'" class="px-6 py-1.5 leading-tight text-white uppercase rounded-lg bg-primary max-w-40">Perpajakan individual</button>
                <button x-on:click="tab = 'tab4'" class="px-6 py-1.5 leading-tight text-white uppercase rounded-lg bg-primary max-w-40">Perpajakan perusahaan</button>
                <button x-on:click="tab = 'tab5'" class="px-6 py-1.5 leading-tight text-white uppercase rounded-lg bg-primary max-w-40">virtual manager</button>
                <button x-on:click="tab = 'tab6'" class="px-6 py-1.5 leading-tight text-white uppercase rounded-lg bg-primary max-w-40">konsultasi</button>
            </div>

            <div x-show="tab === 'tab1'" class=""><x-frontend.charge.layout1 /></div>
            <div x-show="tab === 'tab2'">Tab 2</div>
            <div x-show="tab === 'tab3'">Tab 3</div>
            <div x-show="tab === 'tab4'">Tab 4</div>
            <div x-show="tab === 'tab5'">Tab 5</div>
            <div x-show="tab === 'tab6'">Tab 6</div>
        </div>
    </section>
@endsection
