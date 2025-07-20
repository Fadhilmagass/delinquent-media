<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                    Jadwal Acara
                </h1>
                <p class="text-gray-500 mt-1 text-base">
                    Temukan pertunjukan dan acara musik terbaru di sekitar Anda.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        {{-- Filter Controls --}}
        <div class="bg-white p-5 rounded-2xl shadow-md border border-gray-200">
            <form method="GET" action="{{ route('events.index') }}"
                class="flex flex-col md:flex-row gap-4 items-center w-full" x-data="{ submitForm() { this.$el.submit(); } }">

                {{-- Search --}}
                <div class="w-full md:flex-grow">
                    <label for="search" class="sr-only">Cari Acara</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search"
                            class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 text-gray-800 border border-gray-300 placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                            placeholder="Cari nama acara, venue, atau band..." value="{{ $filters['search'] ?? '' }}"
                            @input.debounce.500ms="submitForm" />
                    </div>
                </div>

                {{-- Filter Select --}}
                <div class="w-full md:w-auto min-w-[200px]">
                    <label for="filter" class="sr-only">Filter Waktu</label>
                    <select name="filter" id="filter"
                        class="w-full py-3 pl-4 pr-10 rounded-xl bg-gray-50 text-gray-800 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                        @change="submitForm">
                        <option value="upcoming" @selected(($filters['filter'] ?? 'upcoming') === 'upcoming')>Acara Mendatang</option>
                        <option value="past" @selected(($filters['filter'] ?? '') === 'past')>Acara Lampau</option>
                        <option value="all" @selected(($filters['filter'] ?? '') === 'all')>Semua Acara</option>
                    </select>
                </div>
            </form>
        </div>

        {{-- Event Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse ($events as $event)
                <a href="{{ route('events.show', $event) }}"
                    class="group bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">

                    {{-- Card Body --}}
                    <div class="p-5 flex gap-5">
                        {{-- Date Badge --}}
                        <div
                            class="flex flex-col items-center justify-center bg-indigo-50 rounded-xl p-3 border border-indigo-100 text-center">
                            <p class="text-sm font-semibold text-indigo-600 uppercase">
                                {{ $event->event_time->format('M') }}
                            </p>
                            <p class="text-3xl font-extrabold text-gray-900">
                                {{ $event->event_time->format('d') }}
                            </p>
                        </div>

                        {{-- Info --}}
                        <div class="flex-1">
                            <h2 class="text-xl font-bold text-gray-800 group-hover:text-indigo-600 transition">
                                {{ $event->name }}
                            </h2>
                            <div class="mt-1 text-sm text-gray-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>{{ $event->venue }}, {{ $event->city }}</span>
                            </div>
                            <div class="mt-1 text-sm text-gray-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $event->event_time->format('H:i') }} WIB</span>
                            </div>
                        </div>
                    </div>

                    {{-- Band Lineup --}}
                    @if ($event->bands->isNotEmpty())
                        <div class="px-5 pb-5 mt-auto border-t border-gray-100 pt-3">
                            <h4 class="text-xs font-semibold text-gray-500 uppercase mb-2">Lineup</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($event->bands->take(4) as $band)
                                    <span class="text-xs bg-gray-100 text-gray-700 px-3 py-1 rounded-full">
                                        {{ $band->name }}
                                    </span>
                                @endforeach
                                @if ($event->bands->count() > 4)
                                    <span class="text-xs bg-gray-200 text-gray-800 font-bold px-3 py-1 rounded-full">
                                        +{{ $event->bands->count() - 4 }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                </a>
            @empty
                <div class="col-span-full text-center bg-white border border-gray-200 p-12 rounded-2xl">
                    <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 16l-3-3-3 3" />
                    </svg>
                    <h3 class="mt-4 text-xl font-semibold text-gray-800">Tidak Ada Acara Ditemukan</h3>
                    <p class="mt-1 text-sm text-gray-500">Coba ubah filter atau periksa kembali nanti.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($events->hasPages())
            <div class="mt-8">
                {{ $events->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
