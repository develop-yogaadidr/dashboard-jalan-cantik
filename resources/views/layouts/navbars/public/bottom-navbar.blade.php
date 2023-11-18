@php
    $contact = config('app.contacts');
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
                    'title' => $contact['location']['alt-title'],
                    'link' => $contact['location']['link'],
                    'icon' => $contact['location']['icon'],
                ],
                [
                    'title' => $contact['phone']['alt-title'],
                    'link' => $contact['phone']['link'],
                    'icon' => $contact['phone']['icon'],
                ],
                [
                    'title' => $contact['email']['alt-title'],
                    'link' => $contact['email']['link'],
                    'icon' => $contact['email']['icon'],
                ],
            ],
        ],

        [
            'title' => 'Sosial Media',
            'items' => [
                [
                    'title' => $contact['instagram']['alt-title'],
                    'link' => $contact['instagram']['link'],
                    'icon' => $contact['instagram']['icon']
                ],
                [
                    'title' => $contact['youtube']['alt-title'],
                    'link' => $contact['youtube']['link'],
                    'icon' => $contact['youtube']['icon']
                ],
                [
                    'title' => $contact['facebook']['alt-title'],
                    'link' => $contact['facebook']['link'],
                    'icon' => $contact['facebook']['icon']
                ],
                [
                    'title' => $contact['twitter']['alt-title'],
                    'link' => $contact['twitter']['link'],
                    'icon' => $contact['twitter']['icon']
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
                                    @if ($sub_item['icon'] != '')
                                        <i class="{{ $sub_item['icon'] }} mr-2"></i>
                                    @endif
                                    <a class="link-light" href="{{ $sub_item['link'] }}">
                                        {{ $sub_item['title'] }}
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
        <hr />
        <div class="text-center">&copy; 2021. Dilindungi Hak Cipta | DPU Bina Marga dan Cipta Karya Provinsi Jaawa Tengah
        </div>
    </div>
</nav>
