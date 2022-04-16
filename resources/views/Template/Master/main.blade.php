<!DOCTYPE html>
<html lang="en">
<head>
    @include('Template.Master.head')
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        @include('Template.Master.navbar')
        @include('Template.Master.sidebar')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1 class="m-0">{{ $title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <section class="content">
                @yield('mainContent')
            </section>
        </div>
    </div>
    @include('Template.Master.js')
</body>
</html>