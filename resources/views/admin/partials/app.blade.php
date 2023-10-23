<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Articles</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('admin/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/styles.min.css') }}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('admin.partials.sidebar')
        <!--  Main wrapper -->
        <div class="body-wrapper">
            @include('admin.partials.navbar')
            <div class="container-fluid">
                <!--  Row 1 -->
                @stack('content')
                @include('admin.partials.footer')
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('admin/js/app.min.js') }}"></script>
    <script src="{{ asset('admin/libs/simplebar/dist/simplebar.js') }}"></script>
    @stack('script')
</body>

</html>
