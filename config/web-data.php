<?php

return [
    'services' => [
        [
            'title' => 'Akuntansi Keuangan',
            'slug' => 'akuntansi-keuangan',
            'sub_menu' => [
                [
                    'title' => 'Accounting Service / Pembukuan',
                    'desc' => 'Jasa Pembukuan dan Akuntansi',
                    'slug' => 'accounting-service',
                ],
                [
                    'title' => 'Accounting Service / Pembukuan',
                    'desc' => 'Jasa Pembukuan dan Akuntansi',
                    'slug' => 'accounting-service',
                ],
                [
                    'title' => 'Accounting Service / Pembukuan',
                    'desc' => 'Jasa Pembukuan dan Akuntansi',
                    'slug' => 'accounting-service',
                ],
            ],
        ],
        [
            'title' => 'Pajak',
            'slug' => 'pajak',
            'sub_menu' => [
                [
                    'title' => 'Pajak Individu 1',
                    'desc' => 'Pelaporan Pajak',
                    'slug' => 'pajak-individu',
                ],
                [
                    'title' => 'Pajak Individu 2',
                    'desc' => 'Pelaporan Pajak',
                    'slug' => 'pajak-individu',
                ],
                [
                    'title' => 'Pajak Individu 3',
                    'desc' => 'Pelaporan Pajak',
                    'slug' => 'pajak-individu',
                ],
            ],
        ],
        [
            'title' => 'Penggajian',
            'slug' => 'penggajian',
            'sub_menu' => [
                [
                    'title' => 'Payroll Service 1',
                    'desc' => 'Jasa Penggajian',
                    'slug' => 'payroll-service',
                ],
                [
                    'title' => 'Payroll Service 2',
                    'desc' => 'Jasa Penggajian',
                    'slug' => 'payroll-service',
                ],
                [
                    'title' => 'Payroll Service 3',
                    'desc' => 'Jasa Penggajian',
                    'slug' => 'payroll-service',
                ],
            ],
        ],
    ],

    'charges' => [
        'akuntansi_perpajakan' => [
            'category' => 'Akuntansi & perpajakan',
            'slug' => 'akuntansi-perpajakan',
            'note' => 'Jika tidak memungkinkan untuk informasi SKU, kami akan merekomendasikan pencatatan dengan sistem akutansi',
            'paket' => [
                [
                    'title' => 'STATER',
                    'slug' => 'stater',
                    'sub_title' => 'ACCOUNTING TAX',
                    'price' => '2 Juta / Bulan',
                    'min_contract' => '1 Tahun',

                    'coverage' => [
                        [
                            'key' => 'Jumlah Penghasilan',
                            'value' => '< Rp 600 Juta / Tahun',
                        ],
                        [
                            'key' => 'Jumlah Transaksi',
                            'value' => '< 250 Transaksi / Tahun',
                        ],
                        [
                            'key' => 'PKP',
                            'value' => 'Tidak',
                        ],
                        [
                            'key' => 'Persediaan',
                            'value' => 'Tidak',
                        ],
                        [
                            'key' => 'Perhitungan HPP',
                            'value' => 'Tidak',
                        ],
                    ],
                    'fitur' => [
                        [
                            'key' => 'Jurnal Akuntansi',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Laporan Keuangan: Neraca, Laba Rugi, Buku Besar',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPh 21',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPh 23',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPh 4(2)',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPh UMKM',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Jumlah faktur pajak',
                            'value' => 'false',
                        ],
                        [
                            'key' => 'Pembuatan Bukti Potong dan Faktur Pajak PPN',
                            'value' => 'false',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPN',
                            'value' => 'false',
                        ],
                    ],
                    'free' => [
                        [
                            'key' => 'Pendanmpingan EFIN',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Pendanmpingan Pengukuhan PKP',
                            'value' => 'false',
                        ],
                        [
                            'key' => 'Respons SP2DK atas periode pelaporan kami',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'SPT tahunan',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Konsultasi & Support Online Harian',
                            'value' => '1x / bulan',
                        ],
                        [
                            'key' => 'Konsultasi offline @1 jam',
                            'value' => 'false',
                        ],
                    ],
                    'additional' => [
                        [
                            'key' => 'Rekap penjualan dan penerimaan uang',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Rekap penjualan per SKU dan Harga*',
                            'value' => '',
                        ],
                        [
                            'key' => 'Rekap pembelian dan pengeluaran uang',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Rekap penjualan per SKU dan Harga*',
                            'value' => '',
                        ],
                        [
                            'key' => 'Rekening Koran',
                            'value' => 'true',
                        ]
                    ],
                ],
                [
                    'title' => 'BASIC',
                    'slug' => 'basic',
                    'sub_title' => 'ACCOUNTING TAX',
                    'price' => '2 Juta / Bulan',
                    'min_contract' => '1 Tahun',
                    'coverage' => [
                        [
                            'key' => 'Jumlah Penghasilan',
                            'value' => '< Rp 600 Juta / Tahun',
                        ],
                        [
                            'key' => 'Jumlah Transaksi',
                            'value' => '< 250 Transaksi / Tahun',
                        ],
                        [
                            'key' => 'PKP',
                            'value' => 'Tidak',
                        ],
                        [
                            'key' => 'Persediaan',
                            'value' => 'Tidak',
                        ],
                        [
                            'key' => 'Perhitungan HPP',
                            'value' => 'Tidak',
                        ],
                    ],
                    'fitur' => [
                        [
                            'key' => 'Jurnal Akuntansi',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Laporan Keuangan: Neraca, Laba Rugi, Buku Besar',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPh 21',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPh 23',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPh 4(2)',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPh UMKM',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Jumlah faktur pajak',
                            'value' => 'false',
                        ],
                        [
                            'key' => 'Pembuatan Bukti Potong dan Faktur Pajak PPN',
                            'value' => 'false',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPN',
                            'value' => 'false',
                        ],
                    ],
                    'free' => [
                        [
                            'key' => 'Pendanmpingan EFIN',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Pendanmpingan Pengukuhan PKP',
                            'value' => 'false',
                        ],
                        [
                            'key' => 'Respons SP2DK atas periode pelaporan kami',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'SPT tahunan',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Konsultasi & Support Online Harian',
                            'value' => '1x / bulan',
                        ],
                        [
                            'key' => 'Konsultasi offline @1 jam',
                            'value' => 'false',
                        ],
                    ],
                    'additional' => [
                        [
                            'key' => 'Rekap penjualan dan penerimaan uang',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Rekap penjualan per SKU dan Harga*',
                            'value' => '',
                        ],
                        [
                            'key' => 'Rekap pembelian dan pengeluaran uang',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Rekap penjualan per SKU dan Harga*',
                            'value' => '',
                        ],
                        [
                            'key' => 'Rekening Koran',
                            'value' => 'true',
                        ]
                    ],
                ],
                [
                    'title' => 'PRO',
                    'slug' => 'pro',
                    'sub_title' => 'ACCOUNTING TAX',
                    'price' => '2 Juta / Bulan',
                    'min_contract' => '1 Tahun',
                    'coverage' => [
                        [
                            'key' => 'Jumlah Penghasilan',
                            'value' => '< Rp 600 Juta / Tahun',
                        ],
                        [
                            'key' => 'Jumlah Transaksi',
                            'value' => '< 250 Transaksi / Tahun',
                        ],
                        [
                            'key' => 'PKP',
                            'value' => 'Ya',
                        ],
                        [
                            'key' => 'Persediaan',
                            'value' => 'Ya',
                        ],
                        [
                            'key' => 'Perhitungan HPP',
                            'value' => 'Ya',
                        ],
                    ],
                    'fitur' => [
                        [
                            'key' => 'Jurnal Akuntansi',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Laporan Keuangan: Neraca, Laba Rugi, Buku Besar',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPh 21',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPh 23',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPh 4(2)',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPh UMKM',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Jumlah faktur pajak',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Pembuatan Bukti Potong dan Faktur Pajak PPN',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPN',
                            'value' => 'true',
                        ],
                    ],
                    'free' => [
                        [
                            'key' => 'Pendanmpingan EFIN',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Pendanmpingan Pengukuhan PKP',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Respons SP2DK atas periode pelaporan kami',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'SPT tahunan',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Konsultasi & Support Online Harian',
                            'value' => '3x / bulan',
                        ],
                        [
                            'key' => 'Konsultasi offline @1 jam',
                            'value' => 'true',
                        ],
                    ],
                    'additional' => [
                        [
                            'key' => 'Rekap penjualan dan penerimaan uang',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Rekap penjualan per SKU dan Harga*',
                            'value' => '',
                        ],
                        [
                            'key' => 'Rekap pembelian dan pengeluaran uang',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Rekap penjualan per SKU dan Harga*',
                            'value' => '',
                        ],
                        [
                            'key' => 'Rekening Koran',
                            'value' => 'true',
                        ]
                    ],
                ],
                [
                    'title' => 'ENTERPRISE',
                    'slug' => 'enterprise',
                    'sub_title' => 'ACCOUNTING TAX',
                    'price' => '2 Juta / Bulan',
                    'min_contract' => '1 Tahun',
                    'coverage' => [
                        [
                            'key' => 'Jumlah Penghasilan',
                            'value' => '< Rp 600 Juta / Tahun',
                        ],
                        [
                            'key' => 'Jumlah Transaksi',
                            'value' => '< 250 Transaksi / Tahun',
                        ],
                        [
                            'key' => 'PKP',
                            'value' => 'Ya',
                        ],
                        [
                            'key' => 'Persediaan',
                            'value' => 'Ya',
                        ],
                        [
                            'key' => 'Perhitungan HPP',
                            'value' => 'Ya',
                        ],
                    ],
                    'fitur' => [
                        [
                            'key' => 'Jurnal Akuntansi',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Laporan Keuangan: Neraca, Laba Rugi, Buku Besar',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPh 21',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPh 23',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPh 4(2)',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPh UMKM',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Jumlah faktur pajak',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Pembuatan Bukti Potong dan Faktur Pajak PPN',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Perhitungan & Pelaporan PPN',
                            'value' => 'true',
                        ],
                    ],
                    'free' => [
                        [
                            'key' => 'Pendanmpingan EFIN',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Pendanmpingan Pengukuhan PKP',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Respons SP2DK atas periode pelaporan kami',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'SPT tahunan',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Konsultasi & Support Online Harian',
                            'value' => '3x / bulan',
                        ],
                        [
                            'key' => 'Konsultasi offline @1 jam',
                            'value' => 'true',
                        ],
                    ],
                    'additional' => [
                        [
                            'key' => 'Rekap penjualan dan penerimaan uang',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Rekap penjualan per SKU dan Harga*',
                            'value' => '',
                        ],
                        [
                            'key' => 'Rekap pembelian dan pengeluaran uang',
                            'value' => 'true',
                        ],
                        [
                            'key' => 'Rekap penjualan per SKU dan Harga*',
                            'value' => '',
                        ],
                        [
                            'key' => 'Rekening Koran',
                            'value' => 'true',
                        ]
                    ],
                ],
            ],
        ],
        'akuntansi' => [
            'category' => 'Akuntansi',
            'slug' => 'akuntansi',
            'note' => null,
            'paket' => [
                [
                    'title' => 'PAKET PEMBUKUAN DAN PELAPORAN KEUANGAN BULANAN',
                    'sub_title' => null,
                    'table_header' => [
                        'OMSET BULANAN',
                        'JUMLAH TRANSAKSI MAX / BULAN',
                        'BIAYA / BULAN',
                    ],
                    'table' => [
                        [
                            'cells' => [
                                '< 100 Juta',
                                '50',
                                '2.000.000',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                '100 Juta - 200 Juta',
                                '75',
                                '2.500.000',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                '200 Juta - 400 Juta',
                                '150',
                                '3.000.000',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                '400 Juta - 1 Miliar',
                                '250',
                                '5.000.000',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                '> 1 Miliar',
                                '>250',
                                '',
                            ],
                            'button' => [
                                'text' => 'hubungi kami',
                                'url' => '#'
                            ]
                        ],
                    ],
                    'note' => null,
                    'button' => null
                ],
                [
                    'title' => 'pembuatan laporan keuangan dan catatan atas laporan keuangan',
                    'sub_title' => null,
                    'table_header' => [
                        'biaya / bulan',
                        'biaya / bulan',
                    ],
                    'table' => [
                        [
                            'cells' => [
                                'a. Satu bahasa (Indonesia / Inggris)',
                                'START FROM Rp 5.000.000'
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'b. Bilingual (Indonesia dan Inggris)',
                                'START FROM Rp 7.500.000'
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                    ],
                    'note' => null,
                    'button' => null,
                ],
                [
                    'title' => 'implementasi sistem akuntansi',
                    'sub_title' => null,
                    'table_header' => [
                        'accurate',
                        '1 hari',
                        '3 bulan',
                        '6 bulan',
                    ],
                    'table' => [
                        [
                            'cells' => [
                                'Training',
                                '1.500.000',
                                '',
                                ''
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Palek Implementasi: <br> Set-up & pendampingan',
                                '',
                                '18.000.000',
                                '35.000.000'
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                    ],
                    'note' => null,
                    'button' => null,
                ],
                [
                    'title' => 'penempatan staff',
                    'sub_title' => 'START FROM Rp 6.000.000 / BULAN',
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Ambil Paket',
                        'url' => '#'
                    ],
                ],
                [
                    'title' => 'check-up laporan keuangan',
                    'sub_title' => 'START FROM Rp 10.000.000 / BULAN',
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Ambil Paket',
                        'url' => '#'
                    ],
                ],
                [
                    'title' => 'virtual manager accounting',
                    'sub_title' => 'START FROM Rp 5.000.000 / BULAN',
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Ambil Paket',
                        'url' => '#'
                    ],
                ],
                [
                    'title' => 'pelatihan akuntansi dan keuangan',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Hubungi Kami',
                        'url' => '#'
                    ],
                ],
                [
                    'title' => 'review laporan keuangan',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Hubungi Kami',
                        'url' => '#'
                    ],
                ],
                [
                    'title' => 'audit laporan keuangan',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Hubungi Kami',
                        'url' => '#'
                    ],
                ],
            ],
        ],
        'perpajakan_individual' => [
            'category' => 'Perpajakan Individual',
            'slug' => 'perpajakan-individual',
            'note' => null,
            'paket' => [
                [
                   'title' => 'pendaftaran NPWP pribadi',
                    'sub_title' => '200.000/kali',
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Ambil Paket',
                        'url' => '#'
                    ],
                ],
                [
                   'title' => 'pindah KPP',
                    'sub_title' => '500.000/kali',
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Ambil Paket',
                        'url' => '#'
                    ],
                ],
                [
                   'title' => 'laporan SPT Tahunan (penghasilan dalam negeri)',
                    'sub_title' => null,
                    'table_header' => [
                        'PENGHASILAN',
                        'BIAYA / TAHUN',
                    ],
                    'table' => [
                        [
                            'cells' => [
                                'Penghasilan < Rp 600 Juta',
                                '500.000',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Penghasilan < 1,2 Miliar',
                                '700.000',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Penghasilan < 2,4 Miliar',
                                '850.000',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Penghasilan < 4,8 Miliar',
                                '1.500.000',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Penghasilan > 4,8 Miliar',
                                '',
                            ],
                            'button' => [
                                'text' => 'hubungi kami',
                                'url' => '#'
                            ]
                        ],
                    ],
                    'note' => null,
                    'button' => null,
                ],
                [
                   'title' => 'laporan SPT Tahunan (penghasilan dalam negeri + luar negeri)',
                    'sub_title' => null,
                    'table_header' => [
                        'PENGHASILAN',
                        'BIAYA / TAHUN',
                    ],
                    'table' => [
                        [
                            'cells' => [
                                'Penghasilan < 1,2 Miliar',
                                '950.000',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Penghasilan < 2,4 Miliar',
                                '1.100.000',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Penghasilan < 4,8 Miliar',
                                '2.000.000',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Penghasilan > 4,8 Miliar',
                                '',
                            ],
                            'button' => [
                                'text' => 'hubungi kami',
                                'url' => '#'
                            ]
                        ],
                    ],
                    'note' => null,
                    'button' => null,
                ],
                [
                   'title' => 'perencanaan pajak',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Hubungi Kami',
                        'url' => '#'
                    ],
                ],
                [
                   'title' => 'pendampingan pajak dan sp2dk',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Hubungi Kami',
                        'url' => '#'
                    ],
                ],
                [
                   'title' => 'pemeriksaan pajak',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Hubungi Kami',
                        'url' => '#'
                    ],
                ],
                [
                   'title' => 'restitusi pajak',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Hubungi Kami',
                        'url' => '#'
                    ],
                ],
                [
                   'title' => 'sengketa pajak',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Hubungi Kami',
                        'url' => '#'
                    ],
                ],
                [
                   'title' => 'transfer pajak',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Hubungi Kami',
                        'url' => '#'
                    ],
                ],
            ],
        ],
        'perpajakan_perusahaan' => [
            'category' => 'Perpajakan Perusahaan',
            'slug' => 'perpajakan-perusahaan',
            'note' => null,
            'paket' => [
                [
                    'title' => 'administrasi pajak',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => [
                        [
                            'cells' => [
                                'EFIN',
                                'Rp 500.000',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Pindah KPP',
                                'Rp 1000.000',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Pengukuhan PKP dan Sertifikat Elektronik Efaktur',
                                'Rp 500.000',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Pendampingan, jika omzet di bawah 4,8M',
                                'Rp 500.000',
                            ],
                            'button' => [
                                'text' => 'Hubungi Kami',
                                'url' => '#'
                            ]
                        ],
                    ],
                    'note' => null,
                    'button' => null,
                ],
                [
                    'title' => 'Laporan SPT Tahunan perusahaan',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => [
                        [
                            'cells' => [
                                'Omset 0 (belum/tidak ada operasional)',
                                'Rp 500.000/TAHUN',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Omset kurang dari 1 Miliar per Tahun',
                                'Rp 1.500.000/TAHUN',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Omset 1 Miliar s/d 2 Miliar per Tahun',
                                'Rp 2.250.000/TAHUN',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Omset 2 Miliar s/d 4,8 Miliar per Tahun',
                                'Rp 3.000.000',
                            ],
                            'button' => [
                                'text' => 'Ambil Kami',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Omset 4,8 Miliar s/d 9 Miliar per Tahun',
                                'Rp 5.000.000',
                            ],
                            'button' => [
                                'text' => 'Ambil Kami',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Omset > 9 Miliar',
                                '',
                            ],
                            'button' => [
                                'text' => 'Hubungi Kami',
                                'url' => '#'
                            ]
                        ],
                    ],
                    'note' => null,
                    'button' => null,
                ],
                [
                    'title' => 'Laporan SPT Bulanan PPH 21, 22, 23, 25, 26, 4(2) dan pembuatan bukti potong',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => [
                        [
                            'cells' => [
                                'Omset < 200 Juta per Bulan',
                                'Rp 500.000/BULAN',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Omset 200 Juta s/d 400 Juta per Bulan',
                                'Rp 600.000/BULAN',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Omset 400 Juta s/d 750 Juta per Bulan',
                                'Rp 1.000.000/TAHUN',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Omset 750 Juta s/d 1 Miliar per Bulan',
                                'Rp 2.000.000',
                            ],
                            'button' => [
                                'text' => 'Ambil Kami',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Omset 1 Miliar s/d 1,5 Miliar per Bulan',
                                'Rp 3.000.000',
                            ],
                            'button' => [
                                'text' => 'Ambil Kami',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                'Omset 1,5 Miliar s/d 2 Miliar per Bulan',
                                '',
                            ],
                            'button' => [
                                'text' => 'Hubungi Kami',
                                'url' => '#'
                            ]
                        ],
                    ],
                    'note' => null,
                    'button' => null,
                ],
                [
                    'title' => 'SPT bulanan PPN dan pembuatan faktur pajak',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => [
                        [
                            'cells' => [
                                'Kurang dari 20 Faktur Pajak per Bulan',
                                'Rp 300.000/BULAN',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                '20 s/d 50 Faktur Pajak per Bulan',
                                'Rp 500.000/BULAN',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                '50 s/d 150 Faktur Pajak per Bulan',
                                'Rp 1.000.000/BULAN',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                '251 s/d 500 Faktur Pajak per Bulan',
                                'Rp 3.000.000',
                            ],
                            'button' => [
                                'text' => 'Ambil Kami',
                                'url' => '#'
                            ]
                        ],
                        [
                            'cells' => [
                                '> 500 Faktur Pajak per Bulan',
                                '',
                            ],
                            'button' => [
                                'text' => 'Hubungi Kami',
                                'url' => '#'
                            ]
                        ],
                    ],
                    'note' => null,
                    'button' => null,
                ],
                [
                    'title' => 'perencanaan pajak',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Hubungi Kami',
                        'url' => '#'
                    ],
                ],
                [
                    'title' => 'Pendampingan pajak dan SP2DK',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Hubungi Kami',
                        'url' => '#'
                    ],
                ],
                [
                    'title' => 'pemeriksaan pajak',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Hubungi Kami',
                        'url' => '#'
                    ],
                ],
                [
                    'title' => 'restitusi pajak',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Hubungi Kami',
                        'url' => '#'
                    ],
                ],
                [
                    'title' => 'sengketa pajak',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Hubungi Kami',
                        'url' => '#'
                    ],
                ],
                [
                    'title' => 'transfer pricing',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => NULL,
                    'note' => null,
                    'button' => [
                        'text' => 'Hubungi Kami',
                        'url' => '#'
                    ],
                ],
            ],
        ],
        'virtual_manager' => [
            'category' => 'Virtual Manager',
            'slug' => 'virtual-manager',
            'note' => null,
            'paket' => [
                [
                    'title' => 'Virtual Manager',
                    'sub_title' => null,
                    'table_header' => NULL,
                    'table' => [
                        [
                            'cells' => [
                                'Akuntansi dab Keuangan',
                                'START FROMRp 5.000.000/BULAN',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                            ],
                        [
                            'cells' => [
                                'Perpajakan',
                                'START FROMRp 5.000.000/BULAN',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                            ],
                        [
                            'cells' => [
                                'Human Resource',
                                'START FROMRp 5.000.000/BULAN',
                            ],
                            'button' => [
                                'text' => 'Ambil Paket',
                                'url' => '#'
                            ]
                        ]
                    ],
                    'note' => null,
                    'button' => [
                        'text' => 'Hubungi Kami',
                        'url' => '#'
                    ],
                ],
            ]
        ],
        'consultasi' => [
            'category' => 'Konsultasi',
            'slug' => 'konsultasi',
            'note' => null,
            'paket' => [
                [
                    'title' => '30 Menit',
                    'slug' => '30-menit',
                    'sub_title' => null,
                    'price' => 'Rp 250.000',
                    'min_contract' => null,
                    'button' => [
                        'text' => 'Ambil Paket',
                        'url' => '#'
                    ],
                    'meeting' => [
                        [
                            'key' => '',
                            'value' => '30 MENIT',
                        ],
                        [
                            'key' => 'Senin-Jumat 09.00-17.00',
                            'value' => '',
                        ],
                        [
                            'key' => 'Berdasarkan appointment',
                            'value' => '',
                        ],
                    ],
                    'pembukuan' => [
                        'key' => ' Pendampingan Proses Pembukuan',
                        'value' => 'Sesuai Konsultasi',
                    ],
                    'support' => [
                        'key' => 'Email & Chat Support:',
                        'value' => false,
                    ]
                ],
                [
                    'title' => '1 Jam',
                    'slug' => '1-jam',
                    'sub_title' => null,
                    'price' => 'Rp 500.000',
                    'min_contract' => null,
                    'button' => [
                        'text' => 'Ambil Paket',
                        'url' => '#'
                    ],
                    'meeting' => [
                        [
                            'key' => '',
                            'value' => '1 JAM',
                        ],
                        [
                            'key' => 'Senin-Jumat 09.00-17.00',
                            'value' => '',
                        ],
                        [
                            'key' => 'Berdasarkan appointment',
                            'value' => '',
                        ],
                    ],
                    'pembukuan' => [
                        'key' => ' Pendampingan Proses Pembukuan',
                        'value' => 'Sesuai Konsultasi',
                    ],
                    'support' => [
                        'key' => 'Email & Chat Support:',
                        'value' => false,
                    ]
                ],
                [
                    'title' => '2 Jam',
                    'slug' => '2-jam',
                    'sub_title' => null,
                    'price' => 'Rp 800.000',
                    'min_contract' => null,
                    'button' => [
                        'text' => 'Ambil Paket',
                        'url' => '#'
                    ],
                    'meeting' => [
                        [
                            'key' => '',
                            'value' => '2 JAM',
                        ],
                        [
                            'key' => 'Senin-Jumat 09.00-17.00',
                            'value' => '',
                        ],
                        [
                            'key' => 'Berdasarkan appointment',
                            'value' => '',
                        ],
                    ],
                    'pembukuan' => [
                        'key' => ' Pendampingan Proses Pembukuan',
                        'value' => 'Sesuai Konsultasi',
                    ],
                    'support' => [
                        'key' => 'Email & Chat Support:',
                        'value' => true,
                    ]
                ],
            ],
        ]
    ]
];
