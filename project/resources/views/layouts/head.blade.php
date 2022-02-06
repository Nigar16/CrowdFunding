<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="description" content="CrowdFunding"/>
    <meta name="robots" content="noindex, nofollow">

    <title>@yield('title',"Crowdfunding")</title>

    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/icon.png') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap-theme.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

    @yield('css')
</head>

