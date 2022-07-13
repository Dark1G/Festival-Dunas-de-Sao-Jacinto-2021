<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="icon" sizes="192x192" href="https://static.wixstatic.com/media/984d87_b6a58d56af1242d8b0e8fd8568f83d42%7Emv2.png/v1/fill/w_32%2Ch_32%2Clg_1%2Cusm_0.66_1.00_0.01/984d87_b6a58d56af1242d8b0e8fd8568f83d42%7Emv2.png">
    <link rel="shortcut icon" href="https://static.wixstatic.com/media/984d87_b6a58d56af1242d8b0e8fd8568f83d42%7Emv2.png/v1/fill/w_32%2Ch_32%2Clg_1%2Cusm_0.66_1.00_0.01/984d87_b6a58d56af1242d8b0e8fd8568f83d42%7Emv2.png" type="image/png"/>
    <link rel="apple-touch-icon" href="https://static.wixstatic.com/media/984d87_b6a58d56af1242d8b0e8fd8568f83d42%7Emv2.png/v1/fill/w_32%2Ch_32%2Clg_1%2Cusm_0.66_1.00_0.01/984d87_b6a58d56af1242d8b0e8fd8568f83d42%7Emv2.png" type="image/png"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
