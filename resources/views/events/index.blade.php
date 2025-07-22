<x-app-layout>
    {{-- Latar belakang abu-abu lembut untuk seluruh halaman --}}
    <div class="bg-slate-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            {{-- 1. Header Halaman yang Informatif --}}
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-extrabold text-slate-800 tracking-tight">
                    Kalender Acara
                </h1>
                <p class="mt-3 max-w-2xl mx-auto text-lg text-slate-500">
                    Temukan penampilan, tur, dan acara mendatang dari band favoritmu.
                </p>
            </div>

            {{-- 2. Layout Utama (Kalender di kiri, info di kanan) --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12 items-start">

                {{-- Kolom Utama untuk Kalender --}}
                <div class="lg:col-span-2">
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-xl p-4 sm:p-6">
                        @livewire('event.event-calendar')
                    </div>
                </div>

                {{-- Kolom Sidebar untuk Info Tambahan --}}
                <div class="lg:col-span-1 space-y-8">
                    {{-- 3. Kartu "Acara Mendatang" (Sentuhan Menarik) --}}
                    @livewire('upcoming-events')
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
