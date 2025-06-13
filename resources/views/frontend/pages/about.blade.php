@extends('frontend.layouts.app')

@section('title', __('Tentang Kami'))

@section('content')
    <x-frontend.hero-section :image="asset('img/bg-hero-1.jpg')" />
    <div class="container flex items-center justify-between px-16 py-6 text-white bg-primary">
        <h2>PERCAYAKAN KENUTUHAN PERPAJAKAN DAN AKUNTING PERUSAHAAN ANDA KEPADA KAMI</h2>
        <a href="" data-motion="hover-btn" class="pl-4 pr-2 pt-1 pb-1.5 uppercase bg-secondary rounded-lg overflow-hidden">
            <span animate-slide-x class="flex items-center font-medium text-primary text-nowrap">
                <span>get a quote</span>
                <i data-lucide="chevron-right"></i>
            </span>
        </a>
    </div>
    <section class="container py-20">
        <div class="text-3xl font-semibold text-center uppercase text-underline">Tentang Kami</div>
        <div class="mx-[10%]">
            <p class="mt-8 max-md:text-sm md:text-center">
                 Teman Konsultan, didirikan oleh profesional berpengalaman lebih dari 10 tahun di bidang akuntansi, keuangan, audit
                dan perpajakan, serta terbiasa menangani perusahaan domestik, multi nasional, pemerintahan. Berkolaborasi dengan
                ahli di berbagai bidang seperti hukum dan teknologi, kami menawarkan solusi terintegrasi satu pintu di bidang
                keuangan, perpajakan, akuntansi, penggajian, hukum, teknologi, konsultasi dan audit.
            </p>
            <p class="mt-4 max-md:text-sm md:text-center">
                Berlandaskan harapan yang tulus untuk mendukung perkembangan bisnis dan mempermudah pekerjaan pemilik
                bisnis serta manajemen atas, serta didukung oleh tim professional kami, kami memastikan semua pekerjaan kami
                dilakukan dengan standar tertinggi berdasarkan nilai-nilai profesionalisme, tanggung jawab dan integritas.
            </p>
        </div>
    </section>
    <section class="grid grid-cols-2">
        <div class="px-[15%] bg-gray-300 py-10">
            <div class="text-3xl font-semibold uppercase text-underline-left">value kami</div>
            <div class="pt-6 space-y-4">
                <div>
                    <h3 class="text-xl uppercase text-primary">CARE</h3>
                    <p>Kami peduli dan selalu menjadi pendengar yang baik</p>
                </div>
                <div>
                    <h3 class="text-xl uppercase text-primary">STRATEGIC THINKING</h3>
                    <p>Kami menganalisa permasalahan, memikirkan berbagai alternatif solusi termasuk dengan dampaknya</p>
                </div>
                <div>
                    <h3 class="text-xl uppercase text-primary">PROFESSIONAL</h3>
                    <p>Kami bersikap profesional</p>
                </div>
                <div>
                    <h3 class="text-xl uppercase text-primary">ACCOUNTABILITY</h3>
                    <p>Kami bertanggung jawab dalam setiap hal yang kami lakukan</p>
                </div>
                <div>
                    <h3 class="text-xl uppercase text-primary">RESPECT</h3>
                    <p>Kami menghargai orang lain dan menempatkan diri kami pada posisi orang lain</p>
                </div>
                <div>
                    <h3 class="text-xl uppercase text-primary">COLLABORATIVE</h3>
                    <p> Kami berkolaborasi dan bekerja sama dalam tim</p>
                </div>
            </div>
        </div>
        <div class="grid grid-rows-2">
            <div class="py-10 bg-primary px-[10%]">
                <div class="text-3xl font-semibold text-white uppercase text-underline-left">visi kami</div>
                <ol class="pt-6 ml-4 text-white list-disc">
                    <li> Memberikan layanan terintegrasi satu pintu di bidang
                        keuangan, perpajakan, akuntansi, penggajian, hukum,
                        teknologi, konsultasi dan audit, sehingga memudahkan klien
                        atas semua dukungan back-o ce yang diperlukan.
                    </li>
                    <li>
                        Menjadi pusat informasi dan membagikan pengetahuan kami
                        tentang peraturan dan standar-standar akuntansi, keuangan
                        dan perpajakan, ke seluruh pemangku kepentingan.
                    </li>
                </ol>
            </div>
            <div class="bg-secondary px-[10%] py-10">
                <div class="text-3xl font-semibold uppercase text-primary text-underline-left-blue">MISI KAMI</div>
                <ol class="pt-6 ml-4 list-disc">
                    <li>
                        Memberikan pelayanan secara profesional yang berkualitas
                        dan komprehensif dengan menjunjung value kami.
                    </li>
                    <li>
                         Mengedepankan kompetensi sumber daya manusia dengan
                        mengikuti pelatihan-pelatihan dan juga pendidikan
                        profesional berkelanjutan.
                    </li>
                    <li>
                        Menjalin kemitraan dan kolaborasi dengan pihak pihak yang
                        terkait dengan profesi
                    </li>
                </ol>
            </div>
        </div>
    </section>
@endsection
