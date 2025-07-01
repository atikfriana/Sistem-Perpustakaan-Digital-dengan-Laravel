<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sistem Perpustakaan') }}</title>

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


    <div id="app">
        {{-- Konten utama --}}
        @yield('content')
    </div>

    {{-- Include JS & toastr --}}
    @include('layouts.scripts')
</body>
</html>
