<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h1 class="text-3xl font-bold text-slate-800 leading-tight">
                    {{ $event->name }}
                </h1>
                <p class="text-slate-500 mt-1">Detail Acara</p>
            </div>
            <a href="{{ route('events.index') }}"
                class="mt-4 md:mt-0 text-sm font-semibold text-indigo-600 hover:text-indigo-700">&larr; Kembali ke semua
                acara</a>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Kolom Kiri: Detail Acara --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white border border-slate-200 rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-slate-800 mb-4">Detail Informasi</h2>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-indigo-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-slate-700">Tanggal & Waktu</h3>
                            <p class="text-slate-600">{{ $event->event_time->format('l, d F Y') }} pukul
                                {{ $event->event_time->format('H:i') }} WIB</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-indigo-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-slate-700">Lokasi</h3>
                            <p class="text-slate-600">{{ $event->venue }}, {{ $event->city }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white border border-slate-200 rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-slate-800 mb-4">Deskripsi</h2>
                <div class="prose max-w-none text-slate-600">
                    {!! $event->description !!}
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Lineup --}}
        <div class="lg:col-span-1">
            <div class="bg-white border border-slate-200 rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-slate-800 mb-4">Lineup</h2>
                <div class="space-y-4">
                    @forelse ($event->bands as $band)
                        <a href="{{ route('bands.show', $band) }}"
                            class="flex items-center p-3 -mx-3 rounded-lg hover:bg-slate-100 transition-colors duration-200">
                            <img src="{{ $band->getFirstMediaUrl('band-photos', 'thumb') ?: 'https://ui-avatars.com/api/?name=' . urlencode($band->name) . '&color=7F9CF5&background=EBF4FF' }}"
                                alt="Foto {{ $band->name }}" class="w-12 h-12 object-cover rounded-full mr-4">
                            <div>
                                <p class="font-semibold text-slate-700">{{ $band->name }}</p>
                                <p class="text-sm text-slate-500">{{ $band->genre }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="text-slate-500">Informasi lineup belum tersedia.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
