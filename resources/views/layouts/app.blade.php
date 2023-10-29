@include('layouts.headers.header')

<body class="antialiased">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            @include('layouts.navbars.public.navbar')
            <!-- Main Content -->
            <div id="content" style="margin-top:102px">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

    </div>
</body>

@include('layouts.footers.footer')
