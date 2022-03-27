<!DOCTYPE html>
<html lang="en">
<head>
    @include('Template.Auth.head')
</head>
<body>
    <div class="limiter">
        @yield('authContent')
    </div>
    <div id="dropDownSelect1"></div>

    @include('Template.Auth.js')
</body>
</html>