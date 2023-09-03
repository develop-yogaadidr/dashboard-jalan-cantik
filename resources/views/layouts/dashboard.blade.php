@include('layouts.headers.header')

<body class="antialiased">
    <div id="wrapper">
        @include('layouts.navbars.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                @include('layouts.navbars.navbar')

                <div class="container-fluid">
                    <!-- Page Heading -->
                    @if (isset($title) && $title != '')
                        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
                    @endif
                    @if (isset($description) && $description != '')
                        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table
                            below.
                            For more information about DataTables, please visit the <a target="_blank"
                                href="https://datatables.net">official DataTables documentation</a>.</p>
                    @endif


                    @yield('content')

                </div>
            </div>
        </div>

    </div>
</body>

@include('layouts.footers.footer')
