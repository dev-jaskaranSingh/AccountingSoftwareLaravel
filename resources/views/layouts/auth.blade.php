<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- Mirrored from webapplayers.com/inspinia_admin-v2.9.2/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 02 Jul 2019 07:38:19 GMT -->
<head>
    <base href="{{ asset('template') }}/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(request()->route()->getPrefix() == '/user')
        <title>User::Login </title>
    @else
        <title>Admin::Login </title>
    @endif

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

</head>

<body class="gray-bg">

    @yield('content')

<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>

</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.9.2/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 02 Jul 2019 07:38:19 GMT -->
</html>
