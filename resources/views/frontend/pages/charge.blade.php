@extends('frontend.layouts.app')

@section('title', __('Harga'))

@section('content')
    <section class="py-20 bg-[#e7e8ea]">
        <div class="container">
            <h2 class="block text-3xl font-bold text-center uppercase text-underline text-primary">Harga</h2>
            <p class="w-3/5 pt-10 mx-auto text-center">Berikut adalah Harga Paket Pupular kami, terutama untuk Perusahaan Star Up dan UMKM. Untuk pertanyaan lebih lanjut, ataupun jasa lainnya, konsultasikan langsung ke kami.</p>
        </div>

        <div x-data="{ tab: 'tab2' }" class="space-y-10">
            <div class="flex justify-center gap-4 pt-10">
                <button x-on:click="tab = 'tab1'" class="pricelist-tabs" x-bind:class="{'active': tab == 'tab1'}">Akuntansi & Perpajakan</button>
                <button x-on:click="tab = 'tab2'" class="pricelist-tabs" x-bind:class="{'active': tab == 'tab2'}">Akuntansi</button>
                <button x-on:click="tab = 'tab3'" class="pricelist-tabs" x-bind:class="{'active': tab == 'tab3'}">Perpajakan individual</button>
                <button x-on:click="tab = 'tab4'" class="pricelist-tabs" x-bind:class="{'active': tab == 'tab4'}">Perpajakan perusahaan</button>
                <button x-on:click="tab = 'tab5'" class="pricelist-tabs" x-bind:class="{'active': tab == 'tab5'}">virtual manager</button>
                <button x-on:click="tab = 'tab6'" class="pricelist-tabs" x-bind:class="{'active': tab == 'tab6'}">konsultasi</button>
            </div>

            <div x-show="tab === 'tab1'" class=""><x-frontend.charge.akuntansi-perpajakan /></div>
            <div x-show="tab === 'tab2'" class="text-center"><x-frontend.charge.layout-card :data="config('web-data.charges.akuntansi')"/></div>
            <div x-show="tab === 'tab3'" class="text-center"><x-frontend.charge.layout-card :data="config('web-data.charges.perpajakan_individual')"/></div>
            <div x-show="tab === 'tab4'" class="text-center"><x-frontend.charge.layout-card :data="config('web-data.charges.perpajakan_perusahaan')"/></div>
            <div x-show="tab === 'tab5'" class="text-center"><x-frontend.charge.layout-card :data="config('web-data.charges.virtual_manager')"/></div>
            <div x-show="tab === 'tab6'" class="text-center">Tab 6</div>
        </div>
    </section>
@endsection
