<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/icons/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icons/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icons/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/icons/favicon_io/site.webmanifest">

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
