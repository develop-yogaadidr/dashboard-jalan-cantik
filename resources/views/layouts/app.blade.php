@include('layouts.headers.public.header')

<body class="antialiased">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            @include('layouts.navbars.public.navbar')
            <!-- Main Content -->
            <div id="content" style="margin-top:102px;min-height:calc(100vh - 100px)">
                @yield('content')
            </div>
            @include('layouts.navbars.public.bottom-navbar')

        </div>

    </div>
</body>

@include('layouts.footers.public.footer')
