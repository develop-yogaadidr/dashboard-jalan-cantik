@include('layouts.headers.public.header')

<body class="antialiased">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                @yield('content')
            </div>
        </div>
    </div>
</body>
@include('layouts.footers.public.footer')
