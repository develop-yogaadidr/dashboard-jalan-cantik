@php
    $profile = session('profile');
@endphp

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar static-top" style="border-bottom: 1px solid #eaeaea">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - User Information -->
        {{-- <li class="nav-item dropdown no-arrow mr-3">
            <a class="nav-link dropdown-toggle position-relative" href="#" id="notificationDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="position-relative circle-container">
                    <i class="fas fa-bell"></i>
                    <span class="position-absolute top-30 start-100 translate-middle badge rounded-pill bg-danger">
                        99+
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </div>
            </a>
        </li> --}}
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <div class="text-right mr-2">
                    <div><span class="mr-2 d-none d-lg-inline text-warning"
                            style="font-weight:bold">{{ $profile->name }}</span></div>
                    <div><span class="mr-2 d-none d-lg-inline small">{{ $profile->role }}</span></div>
                </div>
                <div class="circle-container text-white">{{ $profile->initial }}</div>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ URL::to('/') }}/dashboard/profile">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda yakin untuk tetap log out dari aplikasi?</div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Batal</button>
                    <x-form method="post" action="{{ URL::to('/') }}/dashboard/logout" need-validation>
                        <x-button color="primary" style="margin-top:0" type="submit">Logout</x-button>
                    </x-form>
                </div>
            </div>
        </div>
    </div>

</nav>
