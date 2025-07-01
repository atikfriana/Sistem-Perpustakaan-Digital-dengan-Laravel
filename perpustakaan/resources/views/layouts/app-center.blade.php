<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Sistem Perpustakaan Digital Multiplatform') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Playfair+Display&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <style>
        body {
            font-family: "Inter", sans-serif;
        }
        .font-playfair {
            font-family: "Playfair Display", serif;
        }
    </style>
</head>
<body class="antialiased bg-gray-50 min-h-screen flex items-center justify-center">
    <div id="app" class="w-full">
        @yield('content')
    </div>

    @include('layouts.scripts')
</body>
</html>
