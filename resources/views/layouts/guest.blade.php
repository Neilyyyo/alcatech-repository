<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-200 antialiased bg-white">

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white">
        <div>
            <a href="/">
            <img src="{{ asset('logo/ALCALOGO.png') }}" alt="Logo" class="mx-auto" style="width: 150px;">

            </a>
        </div>

        <!-- Main Form Container -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md rounded-lg border border-purple-200">
            <!-- Slot for the form content -->
            {{ $slot }}
        </div>
    </div>

</body>
</html>
