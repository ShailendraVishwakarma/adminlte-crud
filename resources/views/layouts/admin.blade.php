<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>

    <!-- AdminLTE CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- 🔹 TOP NAVBAR -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-primary">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('products.index') }}" class="nav-link">
                        Dashboard
                    </a>
                </li>
            </ul>

            <!-- <span class="navbar-brand">Admin Panel</span> -->
            <ul class="navbar-nav ml-auto">

                <!-- User Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                        <span class="ml-1">{{ auth()->user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ route('profile') }}" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>

                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>

            </ul>
        </nav>

        <!-- 🔹 LEFT SIDEBAR (ADDED) -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link text-center">
                <span class="brand-text font-weight-light">AdminLTE</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column">

                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link active">
                                <i class="nav-icon fas fa-box"></i>
                                <p>Products</p>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        <!-- 🔹 CONTENT -->
        <div class="content-wrapper p-4">
            @yield('content')
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>

</html>