<!DOCTYPE html>
<html>
<head>
    @include('layouts.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="wrapper">

        <!-- Navbar -->
        @include('layouts.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        @include('layouts.footer')

        <!-- Control Sidebar -->
        @include('layouts.right-sidebar')
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    @include('layouts.footer-scripts')
</body>

</html>
