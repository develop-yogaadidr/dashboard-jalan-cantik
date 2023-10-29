@include('layouts.headers.dashboard.header')

<body class="antialiased">
    <div id="wrapper">
        @include('layouts.navbars.dashboard.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                @include('layouts.navbars.dashboard.navbar')

                <div class="container-fluid">
                    <!-- Page Heading -->
                    @if (isset($title) && $title != '')
                        <h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>
                    @endif
                    @if (isset($description) && $description != '')
                        <p class="mb-4">{{ $description }}</p>
                    @endif
                    @if (isset($breadcrumbs) && is_array($breadcrumbs))
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                @foreach ($breadcrumbs as $breadcrumb)
                                    @if ($breadcrumb['link'] == '')
                                        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['label'] }}</li>
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
