@php
    $menu = config('app.public-menu');
    $profile = session('profile');
    $button = $profile == null ? ['title' => 'Login', 'target' => URL::to('/') . '/login'] : ['title' => 'Dashboard', 'target' => URL::to('/') . '/dashboard'];
@endphp

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container-fluid">
        <div class="navbar-brand" href="#">
            <img src="{{ asset('public/images/jalan-cantik.png') }}" alt="Logo" width="72" height="72"
                class="d-inline-block align-text-top mr-2">
            <div class="d-inline-block align-text-top" style="line-height:1.15">
                <h4 class="mb-0">Jalan Cantik</h4>
                <span style="font-size:12px">DPU Bina Marga dan Cipta Karya</span><br />
                <span style="font-size:12px">Provinsi Jawa Tengah</span>
            </div>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav justify-content-end">
                @foreach ($menu as $element)
                    @if (isset($element['sub-items']) && sizeof($element['sub-items']) > 0)
                        <li class="nav-item dropdown mr-3">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Laporan
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach ($element['sub-items'] as $item)
                                    <li><a class="dropdown-item"
                                            href="{{ URL::to('/') . $item['target'] }}">{{ $item['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="nav-item mr-3">
                            <a class="nav-link {{ $element['id'] == ($active_menu ?? '') ? 'active' : ''  }}" href="{{ URL::to('/') . $element['target'] }}" tabindex="-1"
                                aria-disabled="true">{{ $element['name'] }}</a>
                        </li>
                    @endif
                @endforeach
                <li class="nav-item">
                    <a class="btn btn-outline-warning" href="{{ $button['target'] }}" tabindex="-1"
                        aria-disabled="true">{{ $button['title'] }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>