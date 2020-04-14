<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Document')</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/carousel/">
    <!-- Bootstrap core CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}" />
    <!-- Favicons -->
    <meta name="theme-color" content="#563d7c">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>
<body>

        @include('layouts.default.header.index')

        @yield('content')

        @include('layouts.default.footer.index')

<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
