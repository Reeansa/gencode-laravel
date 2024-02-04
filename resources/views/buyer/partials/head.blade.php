<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('buyer/assets/icon/logo.png') }}" type="image/x-icon">
    <!-- Bootstrap  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('buyer/assets/stylesheets/bootstrap.css') }}">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('buyer/assets/stylesheets/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('buyer/assets/stylesheets/responsive.css') }}">

    <!-- Colors -->
    <link rel="stylesheet" type="text/css" href="{{ asset('buyer/assets/stylesheets/colors/color1.css') }}" id="colors">

    <!-- Animation Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('buyer/assets/stylesheets/animate.css') }}">
</head>
