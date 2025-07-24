<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="preload" as="image" href="https://images.unsplash.com/photo-1516273836189-23a43c2b4e8e?q=80&w=2070">

    {{-- Script untuk mencegah FOUC (Flash of Unstyled Content) saat dark mode aktif --}}
    <script>
        if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .card:hover {
            box-shadow: 0 8px 32px rgba(60, 72, 88, 0.15);
            transform: translateY(-2px) scale(1.02);
        }
        html.dark .card:hover {
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
        }

        .logo:hover {
            transform: scale(1.08) rotate(-2deg);
            transition: transform 0.2s;
        }
    </style>
</head>

<body class="font-sans text-gray-900 dark:text-slate-200 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-slate-900 transition-colors duration-500">
        <div>
            <a href="/" wire:navigate class="logo inline-block transition-transform duration-200">
                <x-application-logo class="w-20 h-20 fill-current text-indigo-500 drop-shadow-lg" />
            </a>
        </div>
        <div
            class="card w-full sm:max-w-md mt-6 px-8 py-6 bg-white dark:bg-slate-800 shadow-lg border border-gray-200 dark:border-slate-700 overflow-hidden sm:rounded-2xl">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
