<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title> @yield('title')| Tasks - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Tasks - Dashboard" name="description">
    <meta name="keywords" content="Tasks - Dashboard">
    <meta content="amany zalat" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.png') }}">

    @include('admin.layouts.head-css')
</head>

@yield('body')
<!-- Begin page -->
<div id="layout-wrapper">

    @include('admin.layouts.topbar')
    @include('admin.layouts.sidebar')

    <!-- Begin page -->
    <div class="page-wrapper">

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- end container -->
            </div>
            <!-- end page content -->
            @include('admin.layouts.footer')
        </div>
        <!-- end main content -->
    </div>
    <!-- END wrapper -->

    <!-- right sidebar file here  -->
    @include('admin.layouts.right-sidebar')
    <!-- script file here -->
    @include('admin.layouts.vendor-scripts')
    </body>

</html>
