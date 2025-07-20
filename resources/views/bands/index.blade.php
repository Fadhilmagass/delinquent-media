{{-- resources/views/bands/index.blade.php --}}
<x-app-layout>
    <div class="bg-slate-50 dark:bg-slate-900 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            {{-- Header: Judul, Search, dan Tombol Aksi --}}
            <div class="flex flex-col sm:flex-row items-center justify-between mb-10 gap-4">
                <h1 class="text-4xl font-extrabold text-slate-800 tracking-tight">
                    Band Directory
                </h1>
                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <form method="GET" action="{{ route('bands.index') }}" class="flex-grow sm:flex-grow-0">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="w-full rounded-full border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 py-2.5 pl-10 pr-4 focus:ring-2 focus:ring-sky-500 focus:outline-none transition"
                                placeholder="Search bands...">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                                </svg>
                            </span>
                        </div>
                    </form>
                    @role('admin')
                        <a href="{{ route('bands.create') }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-sky-600 text-white font-semibold shadow-lg hover:bg-sky-700 hover:scale-105 transition-all duration-300">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Add Band</span>
                        </a>
                    @endrole
                </div>
            </div>

            {{-- Grid Daftar Band --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @forelse ($bands as $band)
                    <div class="band-card" style="--animation-delay: {{ $loop->index * 100 }}ms;">
                        <a href="{{ route('bands.show', $band) }}"
                            class="group bg-white dark:bg-slate-800 rounded-2xl shadow-lg hover:shadow-sky-500/20
                                   transition-all duration-300 ease-in-out hover:-translate-y-2 overflow-hidden border border-slate-200 dark:border-slate-700 h-full flex flex-col">

                            {{-- Gambar Band --}}
                            <div class="overflow-hidden h-56 relative">
                                @if ($band->hasMedia('band_photos'))
                                    <img src="{{ $band->getFirstMediaUrl('band_photos') }}"
                                        alt="Foto {{ $band->name }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-700 dark:to-slate-800 flex items-center justify-center">
                                        <svg class="h-16 w-16 text-slate-400 dark:text-slate-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 6l12-3" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 p-4">
                                    <h2 class="text-xl font-bold text-white tracking-wide" title="{{ $band->name }}">
                                        {{ $band->name }}
                                    </h2>
                                </div>
                            </div>

                            {{-- Info Band --}}
                            <div class="p-5 flex-grow flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center text-sm text-slate-500 dark:text-slate-400">
                                        <svg class="h-4 w-4 mr-1.5 text-sky-500" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ $band->origin }}</span>
                                    </div>
                                    <div class="mt-2">
                                        <span
                                            class="inline-block bg-sky-100 dark:bg-sky-900/50 text-sky-700 dark:text-sky-300 text-xs font-semibold px-2.5 py-1 rounded-full">
                                            {{ $band->genre }}
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right mt-4">
                                    <span class="text-sm font-medium text-sky-600 group-hover:underline">View Details
                                        &rarr;</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    {{-- Jika Kosong --}}
                    <div
                        class="col-span-full text-center py-20 bg-white dark:bg-slate-800/50 rounded-2xl shadow-md border border-slate-200 dark:border-slate-700">
                        <svg class="mx-auto h-20 w-20 text-slate-300 dark:text-slate-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <h3 class="mt-4 text-xl font-semibold text-slate-800 dark:text-white">No Bands Found</h3>
                        <p class="text-slate-500 dark:text-slate-400 mt-1">Your search returned no results. Try a
                            different keyword.</p>
                        @role('admin')
                            <div class="mt-6">
                                <a href="{{ route('bands.create') }}"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-sky-600 text-white font-semibold shadow-lg hover:bg-sky-700 hover:scale-105 transition-all duration-300">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    <span>Add the First Band</span>
                                </a>
                            </div>
                        @endrole
                    </div>
                @endforelse
            </div>

            {{-- Paginasi --}}
            @if ($bands->hasPages())
                <div class="mt-16 border-t border-slate-200 dark:border-slate-700 pt-8">
                    {{ $bands->links('vendor.pagination.tailwind') }}
                </div>
            @endif

        </div>
    </div>
    <style>
        .band-card {
            opacity: 0;
            transform: translateY(20px);
            animation: card-fade-in 0.5s ease forwards;
            animation-delay: var(--animation-delay);
        }

        @keyframes card-fade-in {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</x-app-layout>
