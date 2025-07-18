<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- 1. Menggunakan preconnect untuk optimasi pemuatan font --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">
    {{-- 2. Link "Skip to content" untuk aksesibilitas --}}
    <a href="#main-content"
        class="sr-only focus:not-sr-only focus:absolute focus:z-50 focus:px-4 focus:py-2 focus:bg-white focus:text-gray-800 focus:ring">
        Lewati ke konten
    </a>

    {{-- 3. Wrapper utama dengan latar belakang yang lebih cerah dan bersih --}}
    <div class="flex flex-col min-h-screen bg-gray-50">

        <livewire:layout.navigation />

        @if (isset($header))
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{-- 4. Header yang lebih bermakna dengan tag H1 untuk SEO dan konsistensi --}}
                    <h1 class="text-2xl font-bold leading-tight text-gray-900">
                        {{ $header }}
                    </h1>
                </div>
            </header>
        @endif

        {{-- 5. Spasi vertikal yang lebih lega untuk 'ruang napas' --}}
        <main id="main-content" class="flex-grow py-8 lg:py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{-- Container untuk konten agar tidak menempel di tepi layar --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 sm:p-8 text-gray-900">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>

        {{-- 6. Footer profesional dengan pemisah visual --}}
        <footer class="bg-white border-t border-gray-200 mt-auto py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Hak Cipta Dilindungi.
            </div>
        </footer>
    </div>

    {{-- 7. Indikator loading global yang minimalis untuk Livewire --}}
    <div wire:loading class="fixed top-0 left-0 right-0 z-50">
        <div class="h-1 bg-gradient-to-r from-blue-500 to-teal-400 animate-pulse"></div>
    </div>

    @livewireScripts
</body>

</html>
