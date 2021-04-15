<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
        href="{{asset('dash/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{asset('dash/vendor/fonts/circular-std/style.css')}}"
        rel="stylesheet">
    <link rel="stylesheet"
        href="{{asset('dash/libs/css/style.css')}}">
    <link rel="stylesheet"
        href="{{asset('dash/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">
    @stack('styles')
    @livewireStyles

    <title>@yield('title')</title>
    <link rel="icon"
        href="https://laravel.com/img/favicon/favicon.ico"
        type="image/gif"
        sizes="16x16">
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand"
                    href="index.html">Concept</a>
                <button class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse "
                    id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img"
                                href="#"
                                id="navbarDropdownMenuLink2"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"><img src="{{asset('dash/images/avatar-1.jpg')}}"
                                    alt=""
                                    class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"
                                aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">{{Auth::user()->name}} </h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();"><i
                                        class="fas fa-power-off mr-2"></i>Logout</a>
                                <form method="POST"
                                    id="logout-form"
                                    action="{{ route('logout') }}">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none"
                        href="#">Dashboard</a>
                    <button class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbarNav"
                        aria-controls="navbarNav"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse"
                        id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  {{Request::is('panel/dashboard') ? 'active' : ''}}"
                                    href="{{ route('panel.dashboard.index') }}"><i
                                        class="fa fa-fw fa-tachometer-alt"></i>Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('panel/user') ? 'active' : ''}}"
                                    href="{{ route('panel.user.index') }}"><i
                                        class="fa fa-fw fa-user-circle"></i>User</a>
                            </li>
                            @if (Auth::user()->isAbleTo('permissions-read') && Auth::user()->isAbleTo('roles-read'))
                            <li class="nav-item">
                                @php
                                Request::is('panel/permission') || Request::is('panel/permission') ?
                                $active = true :
                                $active = false;
                                @endphp
                                <a class="nav-link {{$active ? 'active' : ''}}"
                                    href="#"
                                    data-toggle="collapse"
                                    aria-expanded="{{$active ? 'true' : 'false'}}"
                                    data-target="#submenu-1-1"
                                    aria-controls="submenu-1-1"><i class="fas fa-fw fa-cog"></i>Settings</a>
                                <div id="submenu-1-1"
                                    class="collapse submenu {{$active ? 'show' : ''}}"
                                    style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ route('panel.permission.index') }}"><i
                                                    class="fas fa-fw fa-edit"></i>Permissions</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ route('panel.role.index') }}"><i
                                                    class="fas fa-fw fa-users"></i>Roles</a>
                                        </li>
                                    </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                    </li>
                    </ul>
            </div>
            </nav>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end left sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    @yield('content')
    <!-- ============================================================== -->
    <!-- end wrapper  -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="{{asset('dash/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
    <!-- bootstap bundle js -->
    <script src="{{asset('dash/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <!-- slimscroll js -->
    <script src="{{asset('dash/vendor/slimscroll/jquery.slimscroll.js')}}"></script>
    <!-- main js -->
    <script src="{{asset('dash/libs/js/main-js.js')}}"></script>

    @livewireScripts
    @stack('scripts')

</body>

</html>