<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet">

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
    @livewireStyles
    <style>
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar for dark and light mode */
        ::-webkit-scrollbar {
            width: 8px;
        }
        html:not(.dark) ::-webkit-scrollbar {
            background: #f1f5f9;
        }
        html:not(.dark) ::-webkit-scrollbar-thumb {
            background: #64748b;
            border-radius: 4px;
        }
        html.dark ::-webkit-scrollbar {
            background: #1e293b; /* slate-800 */
        }
        html.dark ::-webkit-scrollbar-thumb {
            background: #475569; /* slate-600 */
            border-radius: 4px;
        }
    </style>
</head>

<body class="font-sans antialiased text-slate-800 bg-gradient-to-br from-slate-50 via-slate-100 to-slate-200 dark:from-slate-900 dark:via-slate-850 dark:to-slate-800 dark:text-slate-200 transition-colors duration-500">

    <a href="#main-content"
        class="sr-only focus:not-sr-only focus:absolute focus:z-50 focus:m-4 focus:px-6 focus:py-3 focus:bg-gradient-to-r focus:from-sky-500 focus:to-indigo-600 focus:text-white focus:rounded-lg focus:shadow-lg focus:ring-2 focus:ring-sky-500 focus:outline-none transition-all duration-300">
        Lewati ke konten utama
    </a>

    <div class="flex flex-col min-h-screen bg-transparent">

        {{-- Navigasi utama --}}
        <livewire:layout.navigation />

        {{-- Header opsional --}}
        @if (isset($header))
            <header
                class="bg-gradient-to-r from-white via-slate-100 to-slate-200 shadow-md transition-all duration-300 dark:from-slate-800 dark:via-slate-850 dark:to-slate-900 dark:border-b dark:border-slate-700">
                <div class="max-w-7xl mx-auto py-6 px-6 sm:px-8 lg:px-10">
                    {{ $header }}
                </div>
            </header>
        @endif

        {{-- Konten Utama --}}
        <main id="main-content" class="flex-grow w-full focus:outline-none transition-all duration-300">
            <div class="max-w-7xl mx-auto my-8 px-4 sm:px-6 lg:px-8 bg-white dark:bg-slate-850 rounded-xl shadow-lg py-8 animate-fade-in">
                {{ $slot }}
            </div>
        </main>

        {{-- Footer --}}
        <footer
            class="w-full py-8 border-t border-slate-100 bg-gradient-to-r from-slate-100 to-slate-200 animate-fade-in-down dark:from-slate-850 dark:to-slate-900 dark:border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-slate-500 dark:text-slate-400">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Hak Cipta Dilindungi.
            </div>
        </footer>
    </div>

    {{-- Indikator loading Livewire --}}
    <div wire:loading class="fixed top-0 left-0 right-0 z-50">
        <div class="h-1 bg-gradient-to-r from-sky-500 to-indigo-600 animate-pulse"></div>
    </div>

    @livewireScripts
    <script>
        // Animasi fade-in (sudah ada, biarkan saja)
        document.querySelectorAll('.animate-fade-in').forEach(el => {
            el.style.opacity = 0;
            setTimeout(() => {
                el.style.transition = 'opacity 0.7s';
                el.style.opacity = 1;
            }, 100);
        });
        document.querySelectorAll('.animate-fade-in-down').forEach(el => {
            el.style.opacity = 0;
            el.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                el.style.transition = 'opacity 0.7s, transform 0.7s';
                el.style.opacity = 1;
                el.style.transform = 'translateY(0)';
            }, 200);
        });
    </script>

    <!-- FullCalendar.js via CDN -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

    @stack('scripts')
</body>

</html>
