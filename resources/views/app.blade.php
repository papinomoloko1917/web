<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Preload критичных шрифтов -->
    <link rel="preload" href="/fonts/Montserrat/Montserrat-Black.ttf" as="font" type="font/ttf"
        crossorigin="anonymous">
    <link rel="preload" href="/fonts/Montserrat/Montserrat-Bold.ttf" as="font" type="font/ttf"
        crossorigin="anonymous">
    <link rel="preload" href="/fonts/Open_Sans/OpenSans-Regular.ttf" as="font" type="font/ttf"
        crossorigin="anonymous">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @inertiaHead
</head>

<body>
    @inertia
</body>

</html>
