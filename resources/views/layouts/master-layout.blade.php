<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.shared/title-meta', ['title' => $page_title ?? ''])
    @include('layouts.shared/head-css')
    <style>
        body {
            opacity: 0;
            transition: opacity 1s;
        }
    </style>
</head>

<body class="loading"
    data-layout='{"mode": "{{ $theme ?? 'light' }}", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "{{ $theme ?? 'red' }}", "size": "default", "showuser": false}, "topbar": {"color": "red"}, "showRightSidebarOnPageLoad": true}'>
    @include('sweetalert::alert')
     <div id="preloader">
        <div id="status">
            <div class="spinner">Loading...</div>
        </div>
    </div>
    <!-- Begin page -->
    <div id="wrapper">
        @include('layouts.shared/topbar')
        @include('layouts.shared/left-menu')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

    @show
    <div class="content-page">
        <div class="content">
            @yield('content')
        </div>
        <!-- content -->
        @include('layouts.shared/footer')
    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
</div>
<!-- END wrapper -->
@include('layouts.shared/footer-script')
</body>

</html>
