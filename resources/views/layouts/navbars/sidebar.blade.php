<?php

$menu = [
    [
        'header-name' => '',
        'items' => [
            [
                'id' => 'dashboard',
                'name' => 'Dashboard',
                'target' => 'dashboard',
                'icon' => 'fa-tachometer-alt',
            ],
            [
                'id' => 'laporan-masuk',
                'name' => 'Laporan Masuk',
                'target' => '',
                'icon' => 'fa-file',
                'sub-items' => [
                    [
                        'id' => 'status-jalan',
                        'name' => 'Status Jalan',
                        'target' => 'dashboard/laporan/status-jalan',
                    ],
                    [
                        'id' => 'kasus-jalan',
                        'name' => 'Kasus Jalan',
                        'target' => 'dashboard/laporan/kasus-jalan',
                    ],
                ],
            ],
            [
                'id' => 'kelola-ai',
                'name' => 'Kelola AI',
                'target' => 'dashboard/kelola-ai',
                'icon' => 'fa-microchip',
            ],
            [
                'id' => 'kelola-user',
                'name' => 'Kelola User',
                'target' => 'dashboard/kelola-user',
                'icon' => 'fa-users',
            ],
            [
                'id' => 'kelola-peta',
                'name' => 'Kelola Peta Jalan',
                'target' => 'dashboard/kelola-peta',
                'icon' => 'fa-map',
            ],
        ],
    ],
];

?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
        <div class="sidebar-brand-icon">
            <img style="width:30px" src="{{ URL::to('/') }}/public/images/jalan-cantik.png" />
        </div>
        <div class="sidebar-brand-text mx-3">{{ env('APP_NAME', '') }}</div>
    </a>

    <hr class="sidebar-divider my-0">

    @foreach ($menu as $element)
        @if ($element['header-name'] != '')
            <div class="sidebar-heading">
                {{ $element['header-name'] }}
            </div>
        @endif

        @foreach ($element['items'] as $item)
            @if (array_key_exists('sub-items', $item))
                @php
                    $isactive = false;
                    foreach ($item['sub-items'] as $sub) {
                        if($sub['id'] == $active_menu){
                            $isactive = true;
                        }
                    }
                @endphp
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item {{ $isactive ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#colapse-{{ $item['id'] }}" aria-expanded="true"
                        aria-controls="collapse-{{ $item['id'] }}">
                        <i class="fas fa-fw {{ $item['icon'] }}"></i>
                        <span>{{ $item['name'] }}</span>
                    </a>
                    <div id="colapse-{{ $item['id'] }}"
                        class="collapse {{ $isactive ? 'show' : '' }}" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            @foreach ($item['sub-items'] as $subitem)
                                <a class="collapse-item {{ $subitem['id'] == $active_menu ? 'active' : '' }}"
                                    href="{{ URL::to('/') }}/{{ $subitem['target'] }}">{{ $subitem['name'] }}</a>
                            @endforeach
                        </div>
                    </div>
                </li>
            @else
                <!-- Nav Item - Dashboard -->
                <li class="nav-item {{ $item['id'] == $active_menu ? 'active' : '' }}">
                    <a class="nav-link" href="{{ URL::to('/') }}/{{ $item['target'] }}">
                        <i class="fas fa-fw {{ $item['icon'] }}"></i>
                        <span>{{ $item['name'] }}</span></a>
                </li>
            @endif
        @endforeach

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endforeach


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
