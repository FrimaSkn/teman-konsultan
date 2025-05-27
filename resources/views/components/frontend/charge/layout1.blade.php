<div class="flex gap-4">
    <div class="mt-16 space-y-4 basis-[30%] lg:ml-[5%] xl:ml-[8%] 2xl:ml-[20%]">
        <div>
            <div class="text-xl font-semibold leading-tight uppercase">Haraga paket</div>
            <div class="font-semibold leading-tight uppercase" >minimum kontrak</div>
        </div>

        <div>
            <div>Jumlah Penghasilan</div>
            <div>Jumlah Transaksi</div>
            <div>PKP</div>
            <div>Persediaan</div>
            <div>Perhitungan HPP</div>
        </div>

        <div>
            <div class="font-semibold">FITUR</div>
            <div>-</div>
            <div>-</div>
            <div>-</div>
            <div>-</div>
            <div>-</div>
        </div>

        <div>
            <div class="font-semibold">FREE</div>
            <div>-</div>
            <div>-</div>
            <div>-</div>
            <div>-</div>
            <div>-</div>
        </div>

        <div>
            <div class="font-semibold">Gambaran dokument yang diperluakan</div>
            <div>-</div>
            <div>-</div>
            <div>-</div>
            <div>-</div>
            <div>-</div>
        </div>

        <div>
            <small class="italic">* Jika tidak menungkinkan untuk informasi SKU, kami akan merekomendasi pencatatan dengan sistem akutansi</small>
        </div>
    </div>

    <div class="swiper price-swiper basis-[70%]">
        <div class="swiper-wrapper">
            @for ($index = 0; $index < 3; $index++)
            <div class="swiper-slide !w-72">
                <div class="pb-4 overflow-hidden bg-white shadow rounded-2xl w-72">
                    <div class="py-2.5 bg-primary">
                        <div class="text-lg font-semibold leading-none text-center text-white uppercase">STARTER</div>
                        <div class="text-xs font-semibold leading-none text-center text-white uppercase">Accounting tax</div>
                    </div>
                    <div class="px-8 py-2 space-y-4">
                        <div>
                            <div class="text-xl font-semibold leading-tight text-center">2 Juta / Bulan</div>
                            <div class="font-semibold leading-tight text-center">1 Tahun</div>
                        </div>
                        <div class="text-center">
                            <div>-</div>
                            <div>-</div>
                            <div>-</div>
                            <div>-</div>
                            <div>-</div>
                        </div>
                        <div class="text-center pt-7">
                            <div>-</div>
                            <div>-</div>
                            <div>-</div>
                            <div>-</div>
                            <div>-</div>
                        </div>
                        <div class="text-center pt-7">
                            <div>-</div>
                            <div>-</div>
                            <div>-</div>
                            <div>-</div>
                            <div>-</div>
                        </div>
                        <div class="text-center pt-7">
                            <div>-</div>
                            <div>-</div>
                            <div>-</div>
                            <div>-</div>
                            <div>-</div>
                        </div>

                        <div class="flex justify-center">
                            <a href="" class="pl-4 pr-2 pt-2 pb-2.5 uppercase bg-secondary rounded-xl hover:bg-opacity-90 text-primary font-medium text-nowrap inline-flex items-center mt-4 justify-center w-full">
                                <span>ambil paket</span>
                                <i data-lucide="chevron-right" class="size-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

</div>
