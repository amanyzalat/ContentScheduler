<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title> @yield('title') |  Dashboard </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Tasks Dashboard" name="description">
    <meta name="keywords" content="Tasks Dashboard ">
    <meta content="amanyzalay" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{URL::asset('assets/images/favicon.png')}}">

    @include('admin/layouts.head-css')
</head>
@yield('body')

<!-- Start content -->
@yield('content')
<!-- content -->

@include('admin/layouts.vendor-scripts')

</body>

</html>
