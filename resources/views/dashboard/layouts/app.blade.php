<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed"  data-theme="theme-default"
    data-assets-path="assets/" data-template="vertical-menu-template">

    <meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <title> Pages | Re-sellers </title>
    @include('dashboard.layouts.style')
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('dashboard.layouts.aside')
            @yield('style')

            <div class="layout-page">
                @include('dashboard.layouts.nav')
            <div class="content-wrapper">
                @yield('content')

        <div class="layout-overlay layout-menu-toggle">
        </div>
        <div class="content-backdrop fade"></div>
    </div>
            </div>
        </div>
</div>

    <!-- / Layout wrapper -->

    @include('dashboard.layouts.script')
</body>

</html>

