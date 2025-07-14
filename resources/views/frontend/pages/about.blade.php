@extends('frontend.layouts.app')

@section('title', __('Tentang Kami'))

@section('content')
    <x-frontend.hero-section :image="asset('img/asset-1.jpg')" />

    <div class="container flex justify-between gap-2 px-4 py-4 text-white md:items-center max-md:flex-col md:px-16 md:py-6 bg-primary" data-motion="inview-faderight-stg">
        <h2 data-animate="inview-faderight-stg" class="text-sm md:text-base">PERCAYAKAN KENUTUHAN PERPAJAKAN DAN AKUNTING PERUSAHAAN ANDA KEPADA KAMI</h2>
        <a data-animate="inview-faderight-stg" href="" class="pl-4 pr-2 pt-1 pb-1.5 uppercase bg-secondary rounded-lg overflow-hidden w-max max-md:text-sm">
            <span class="flex items-center font-medium text-primary text-nowrap">
                <span>get a quote</span>
                <i data-lucide="chevron-right" class="max-md:size-4"></i>
            </span>
        </a>
    </div>

    <section class="container py-10 md:py-20" data-motion="inview-fadeup-stg">
        <div class="text-xl font-semibold text-center uppercase md:text-3xl text-underline"  data-animate="inview-fadeup-stg">Tentang Kami</div>
        <div class="md:mx-[10%]" data-animate="inview-fadeup-stg">
            <p class="mt-8 md:text-center">
                 Teman Konsultan, didirikan oleh profesional berpengalaman lebih dari 10 tahun di bidang akuntansi, keuangan, audit
                dan perpajakan, serta terbiasa menangani perusahaan domestik, multi nasional, pemerintahan. Berkolaborasi dengan
                ahli di berbagai bidang seperti hukum dan teknologi, kami menawarkan solusi terintegrasi satu pintu di bidang
                keuangan, perpajakan, akuntansi, penggajian, hukum, teknologi, konsultasi dan audit.
            </p>
            <p class="mt-4 md:text-center">
                Berlandaskan harapan yang tulus untuk mendukung perkembangan bisnis dan mempermudah pekerjaan pemilik
                bisnis serta manajemen atas, serta didukung oleh tim professional kami, kami memastikan semua pekerjaan kami
                dilakukan dengan standar tertinggi berdasarkan nilai-nilai profesionalisme, tanggung jawab dan integritas.
            </p>
        </div>
    </section>
    <section class="grid md:grid-cols-2" data-motion="inview-faderight-stg">
        <div class="px-4 md:px-[15%] bg-gray-300 py-10" >
            <div class="text-xl font-semibold uppercase md:text-3xl text-underline-left" data-animate="inview-faderight-stg">value kami</div>
            <div class="pt-6 space-y-4">
                <div data-animate="inview-faderight-stg">
                    <h3 class="text-base uppercase md:text-xl text-primary">CARE</h3>
                    <p>Kami peduli dan selalu menjadi pendengar yang baik</p>
                </div>
                <div data-animate="inview-faderight-stg">
                    <h3 class="text-base uppercase md:text-xl text-primary">STRATEGIC THINKING</h3>
                    <p>Kami menganalisa permasalahan, memikirkan berbagai alternatif solusi termasuk dengan dampaknya</p>
                </div>
                <div data-animate="inview-faderight-stg">
                    <h3 class="text-base uppercase md:text-xl text-primary">PROFESSIONAL</h3>
                    <p>Kami bersikap profesional</p>
                </div>
                <div data-animate="inview-faderight-stg">
                    <h3 class="text-base uppercase md:text-xl text-primary">ACCOUNTABILITY</h3>
                    <p>Kami bertanggung jawab dalam setiap hal yang kami lakukan</p>
                </div>
                <div data-animate="inview-faderight-stg">
                    <h3 class="text-base uppercase md:text-xl text-primary">RESPECT</h3>
                    <p>Kami menghargai orang lain dan menempatkan diri kami pada posisi orang lain</p>
                </div>
                <div data-animate="inview-faderight-stg">
                    <h3 class="text-base uppercase md:text-xl text-primary">COLLABORATIVE</h3>
                    <p> Kami berkolaborasi dan bekerja sama dalam tim</p>
                </div>
            </div>
        </div>
        <div class="grid grid-rows-2">
            <div class="py-10 bg-primary px-4 md:px-[10%]">
                <div class="text-xl font-semibold text-white uppercase md:text-3xl text-underline-left" data-animate="inview-faderight-stg">visi kami</div>
                <ol class="pt-6 ml-4 text-white list-disc">
                    <li data-animate="inview-faderight-stg"> Memberikan layanan terintegrasi satu pintu di bidang
                        keuangan, perpajakan, akuntansi, penggajian, hukum,
                        teknologi, konsultasi dan audit, sehingga memudahkan klien
                        atas semua dukungan back-o ce yang diperlukan.
                    </li>
                    <li data-animate="inview-faderight-stg">
                        Menjadi pusat informasi dan membagikan pengetahuan kami
                        tentang peraturan dan standar-standar akuntansi, keuangan
                        dan perpajakan, ke seluruh pemangku kepentingan.
                    </li>
                </ol>
            </div>
            <div class="bg-secondary px-4 md:px-[10%] py-10">
                <div class="text-xl font-semibold uppercase md:text-3xl text-primary text-underline-left-blue" data-animate="inview-faderight-stg">MISI KAMI</div>
                <ol class="pt-6 ml-4 list-disc">
                    <li data-animate="inview-faderight-stg">
                        Memberikan pelayanan secara profesional yang berkualitas
                        dan komprehensif dengan menjunjung value kami.
                    </li>
                    <li data-animate="inview-faderight-stg">
                         Mengedepankan kompetensi sumber daya manusia dengan
                        mengikuti pelatihan-pelatihan dan juga pendidikan
                        profesional berkelanjutan.
                    </li>
                    <li data-animate="inview-faderight-stg">
                        Menjalin kemitraan dan kolaborasi dengan pihak pihak yang
                        terkait dengan profesi
                    </li>
                </ol>
            </div>
        </div>
    </section>
@endsection
