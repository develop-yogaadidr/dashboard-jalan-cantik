@php

    $menu = [
        [
            'title' => 'Pengaduan & Informasi',
            'items' => [
                [
                    'title' => 'PPID Dinas PU',
                    'link' => 'https://ppid.dpubinmarcipka.jatengprov.go.id/',
                    'icon' => '',
                ],
            ],
        ],
        [
            'title' => 'Informasi',
            'items' => [
                [
                    'title' => 'Tentang Jalan Cantik',
                    'link' => '',
                    'icon' => '',
                ],
                [
                    'title' => 'Download',
                    'link' => '',
                    'icon' => '',
                ],
                [
                    'title' => 'Kritk & Saran',
                    'link' => '',
                    'icon' => '',
                ],
                [
                    'title' => 'DPU Binmarcipka Jawa Tengah',
                    'link' => '',
                    'icon' => '',
                ],
            ],
        ],
        [
            'title' => 'DPU BMCK Jateng',
            'items' => [
                [
                    'title' => 'Jl. Madukoro Blok AA-BB, Semarang 50144',
                    'link' => 'https://www.google.com/maps/place/Dinas+PU+Bina+Marga+dan+Cipta+Karya+Provinsi+Jawa+Tengah/@-6.9622146,110.3971985,19z/data=!4m7!3m6!1s0x2e70f4c6a1903aeb:0xf2e9aab67c0b9195!8m2!3d-6.9622147!4d110.3978563!15sCgpkcHUgamF0ZW5nIgOIAQGSARFnb3Zlcm5tZW50X29mZmljZeABAA!16s%2Fg%2F1td3bvpf?entry=ttu',
                    'icon' => 'fa fa-map-marker',
                ],
                [
                    'title' => '(024) 7608368 Faksimil. (024) 7613181',
                    'link' => '',
                    'icon' => 'fa fa-phone',
                ],
                [
                    'title' => 'dpubinmarcipka@jatengprov.go.id',
                    'link' => '',
                    'icon' => 'fa fa-envelope-o',
                ],
            ],
        ],

        [
            'title' => 'Sosial Media',
            'items' => [
                [
                    'title' => '@dpubinmarcipka',
                    'link' => 'https://www.instagram.com/',
                    'icon' => 'fa fa-instagram',
                ],
                [
                    'title' => 'dpubmckjateng',
                    'link' => 'https://www.youtube.com/@dpubmckjateng3973',
                    'icon' => 'fa fa-youtube-play',
                ],
                [
                    'title' => 'Dinas PU BMCK',
                    'link' => 'https://www.facebook.com/dpubmckjateng',
                    'icon' => 'fa fa-facebook',
                ],
                [
                    'title' => '@dpubmckjateng',
                    'link' => 'https://twitter.com/dpubmckjateng',
                    'icon' => 'fa fa-twitter',
                ],
            ],
        ],
    ];

@endphp

<nav class="navbar-dark bg-dark shadow text-white">
    <div class="container pt-4 pb-4">
        <h3>Jalan Cantik</h3>
        <div class="row">
            @foreach ($menu as $item)
                <div class="col">
                    <h6>{{ $item['title'] }}</h6>
                    <ul class="list-unstyled">
                        @foreach ($item['items'] as $sub_item)
                            <li>
                                @if ($sub_item['link'] != '')
                                    <a href="{{$sub_item['link']}}">
                                        @if ($sub_item['icon'] != '')
                                            <i class="{{ $sub_item['icon'] }} mr-2"></i>
                                        @endif{{ $sub_item['title'] }}
                                    </a>
                                @else
                                    @if ($sub_item['icon'] != '')
                                        <i class="{{ $sub_item['icon'] }} mr-2"></i>
                                    @endif{{ $sub_item['title'] }}
                                @endif

                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
        <hr/>
        <div class="text-center">&copy; 2021. Dilindungi Hak Cipta | DPU Bina Marga dan Cipta Karya Provinsi Jaawa Tengah</div>
    </div>
</nav>
