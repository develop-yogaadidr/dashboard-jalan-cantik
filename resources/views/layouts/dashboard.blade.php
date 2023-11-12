@include('layouts.headers.dashboard.header')

<body class="antialiased">
    <div id="wrapper">
        @include('layouts.navbars.dashboard.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                @include('layouts.navbars.dashboard.navbar')
                <nav class="navbar-light bg-white topbar mb-4 shadow container-fluid">
                    <div class="d-flex bd-highlight align-items-center justify-content-center" style="height: 70px;">
                        <div class="p-2 bd-highlight">
                            <div class="d-flex align-items-center">
                                <!-- Page Heading -->
                                @if (isset($title) && $title != '')
                                    <h2 class="h4 mb-0 text-gray-800 pr-3" style="border-right:1px solid #eaeaea">{{ $title }}</h2>
                                @endif
                            </div>
                        </div>
                        <div class="p-2 flex-grow-1 bd-highlight align-middle">@yield('navbar-content')</div>
                        <div class="p-2 bd-highlight">
                            @if (isset($breadcrumbs) && is_array($breadcrumbs))
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        @foreach ($breadcrumbs as $breadcrumb)
                                            @if ($breadcrumb['link'] == '')
                                                <li class="breadcrumb-item active" aria-current="page">
                                                    {{ $breadcrumb['label'] }}</li>
                                            @else
                                                <li class="breadcrumb-item">
                                                    <a href="{{ URL::to('/') . $breadcrumb['link'] }}">
                                                        {{ $breadcrumb['label'] }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ol>
                                </nav>
                            @endif
                        </div>
                    </div>
                </nav>

                <div class="container-fluid mb-5">
                    @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>

    </div>
</body>

@include('layouts.footers.dashboard.footer')
