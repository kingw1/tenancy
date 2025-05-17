<!DOCTYPE html>
<html lang="th" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ Vite::image('favicon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('css')
</head>

<body class="h-full">

    {{ $slot }}

    @stack('script')
</body>

</html>