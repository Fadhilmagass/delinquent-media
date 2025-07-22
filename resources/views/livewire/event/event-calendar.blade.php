<div class="bg-slate-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 md:py-12">

        {{-- <section class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-800 tracking-tight">Jadwal Gigs & Event</h1>
            <p class="mt-3 max-w-2xl mx-auto text-lg text-slate-500">Temukan acara musik keras di sekitarmu.</p>
        </section> --}}

        <section class="mb-10">
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 items-end bg-white p-6 rounded-2xl shadow-lg border border-slate-200">
                <div class="relative">
                    <label for="filter-kota" class="block text-sm font-semibold text-slate-700 mb-1">Kota</label>
                    <div class="pointer-events-none absolute inset-y-0 right-3 top-7 flex items-center">
                    </div>
                    <select id="filter-kota" wire:model.live="selectedCity"
                        class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-red-500 focus:ring-red-500 transition pl-4 pr-10">
                        <option value="">Pilih Kota</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city }}">{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="relative">
                    <label for="filter-bulan" class="block text-sm font-semibold text-slate-700 mb-1">Bulan</label>
                    <div class="pointer-events-none absolute inset-y-0 right-3 top-7 flex items-center">
                    </div>
                    <select id="filter-bulan" wire:model.live="selectedMonth"
                        class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-red-500 focus:ring-red-500 transition pl-4 pr-10">
                        <option value="">Pilih Bulan</option>
                        @foreach ($months as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="relative">
                    <label for="filter-genre" class="block text-sm font-semibold text-slate-700 mb-1">Genre</label>
                    <div class="pointer-events-none absolute inset-y-0 right-3 top-7 flex items-center">
                    </div>
                    <select id="filter-genre" wire:model.live="selectedGenre"
                        class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-red-500 focus:ring-red-500 transition pl-4 pr-10">
                        <option value="">Pilih Genre</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre }}">{{ $genre }}</option>
                        @endforeach
                    </select>
                </div>
                <button wire:click="resetFilters" type="button"
                    class="w-full h-10 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-all shadow-md flex items-center justify-center">
                    Cari Event
                </button>
            </div>
        </section>

        <div class="flex justify-center mb-10">
            <div class="inline-flex rounded-lg shadow-md overflow-hidden border border-slate-200">
                <button type="button" wire:click="setViewMode('list')"
                    class="px-5 py-2 text-sm font-semibold focus:outline-none transition flex items-center gap-2 {{ $viewMode === 'list' ? 'bg-red-600 text-white' : 'bg-white text-slate-700 hover:bg-slate-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    Daftar
                </button>
                <button type="button" wire:click="setViewMode('calendar')"
                    class="px-5 py-2 text-sm font-semibold focus:outline-none transition flex items-center gap-2 {{ $viewMode === 'calendar' ? 'bg-red-600 text-white' : 'bg-white text-slate-700 hover:bg-slate-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Kalender
                </button>
            </div>
        </div>

        <div>
            @if ($viewMode === 'list')
                @if ($events->count())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($events as $event)
                            <div
                                class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                                <a href="{{ route('events.show', $event) }}" class="block">
                                    <div class="relative">
                                        <div class="h-48 bg-slate-200">
                                            @if ($event->poster_url)
                                                <img src="{{ $event->poster_url }}" alt="Poster {{ $event->name }}"
                                                    class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        <div
                                            class="absolute bottom-0 left-0 bg-gradient-to-t from-black/80 to-transparent w-full h-2/3 p-4 flex flex-col justify-end">
                                            <h3 class="font-bold text-xl text-white tracking-tight">{{ $event->name }}
                                            </h3>
                                            <p class="text-sm text-slate-300">{{ $event->venue }}, {{ $event->city }}
                                            </p>
                                        </div>
                                        <div
                                            class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-center rounded-lg px-3 py-2 shadow">
                                            <span
                                                class="text-2xl font-extrabold text-red-600 leading-none">{{ $event->event_time->format('d') }}</span>
                                            <span
                                                class="text-xs font-semibold text-slate-600 uppercase tracking-wide">{{ $event->event_time->format('M Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <h4 class="text-sm font-semibold text-slate-600 mb-2">Lineup:</h4>
                                        <div class="flex flex-wrap gap-2">
                                            @forelse ($event->bands as $band)
                                                <span
                                                    class="bg-slate-100 text-slate-700 text-xs font-semibold px-2.5 py-1 rounded-full">{{ $band->name }}</span>
                                            @empty
                                                <span class="text-xs text-slate-400 italic">Lineup belum
                                                    diumumkan.</span>
                                            @endforelse
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-12 flex justify-center">{{ $events->links() }}</div>
                @else
                    <div class="text-center bg-white rounded-2xl p-12 border border-dashed">
                        <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-xl font-semibold text-slate-800">Oops, Belum Ada Acara</h3>
                        <p class="mt-1 text-base text-slate-500">Tidak ditemukan event yang sesuai dengan filter Anda.
                            Coba ubah kriteria pencarianmu.</p>
                    </div>
                @endif
            @else
                <div class="bg-white p-4 sm:p-6 rounded-2xl shadow-xl" wire:ignore x-data="calendar">
                    <div x-ref="calendar"></div>
                </div>
            @endif
        </div>

    </div>
</div>
