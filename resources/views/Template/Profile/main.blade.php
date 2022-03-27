<!DOCTYPE html>
<html lang="en">
<head>
    @include('Template.Profile.head')
</head>
<body>
    <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            @include('Template.Dashboard.navbar')
            @include('Template.Dashboard.sidebar')
            <div class="content-wrapper">
                <section class="content">
                    @yield('profileContent')
                </section>
            </div>
        </div>
        @include('Template.Profile.js')
    </body>
</body>
</html>