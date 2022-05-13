<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
            <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="{{ asset('svg/coreui.svg#full') }}"></use>
            </svg>
            <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
                <use xlink:href="{{ asset('svg/coreui.svg#signet') }}"></use>
            </svg>
        </div>
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="nav-icon bi-speedometer2"></span>
                    {{ __('Dashboard') }}
                </a>
            </li>
            <li class="nav-title">{{ __('Resources') }}</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
                    <span class="nav-icon bi-layers"></span>
                    {{ __('Posts') }}
                </a>
            </li>
            <li class="nav-item mt-auto">
                <a class="nav-link nav-link-danger" href="#">
                    <span class="nav-icon bi-box-arrow-left"></span>
                    {{ __('Log Out') }}
                </a>
            </li>
        </ul>
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <header class="header header-sticky mb-4">
            <div class="container-fluid">
                <button class="header-toggler px-md-0 me-md-3" type="button" id="header-toggler">
                    <span class="icon icon-lg bi-list"></span>
                </button>
                <ul class="header-nav ms-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-md">
                                <img class="avatar-img" src="{{ auth()->user()->avatar }}" alt="user@email.com">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pt-0">
                            <div class="dropdown-header bg-light py-2">
                                <div class="fw-semibold">{{ __('Manage Account') }}</div>
                            </div>
                            <a class="dropdown-item" href="#">
                                <span class="icon me-2 bi-person-fill"></span>
                                {{ __('Profile') }}
                            </a>
                            <a class="dropdown-item" href="#">
                                <span class="icon me-2 bi-gear-wide-connected"></span>
                                {{ __('API Tokens') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <span class="icon me-2 bi-box-arrow-left"></span>
                                {{ __('Log Out') }}
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
        <div class="body flex-grow-1 px-3">
            {{ $slot }}
        </div>
        <footer class="footer">
            <div>
                &copy; {{ date('Y') }}
                <a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>.
                {{ __('All rights reserved.') }}
            </div>
            <div class="ms-auto">
                Powered by
                <a href="https://coreui.io">CoreUI</a>
            </div>
        </footer>
    </div>

    @stack('modals')
</body>
</html>
