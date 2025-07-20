<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h1 class="text-3xl font-bold text-slate-800 leading-tight">
                    Direktori Band
                </h1>
                <p class="text-slate-500 mt-1">Temukan band favorit Anda berikutnya.</p>
            </div>
            @role('admin')
                <a href="{{ route('bands.create') }}"
                    class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Tambah Band
                </a>
            @endrole
        </div>
    </x-slot>
    {{-- Form Pencarian --}}
    <div class="mb-8">
        <form method="GET" action="{{ route('bands.index') }}">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full rounded-md border-slate-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Cari band berdasarkan nama, genre, atau asal...">
                <button type="submit"
                    class="absolute right-2 top-1/2 -translate-y-1/2 p-2 rounded-full bg-indigo-600 text-white hover:bg-indigo-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>
    {{-- Grid Daftar Band --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse ($bands as $band)
            <div
                class="bg-white border border-slate-200 rounded-xl shadow-md overflow-hidden transform hover:-translate-y-1 transition-transform duration-300">
                <a href="{{ route('bands.show', $band) }}" class="h-full flex flex-col">
                    <div class="h-48 bg-slate-200">
                        @if ($band->hasMedia('band_photos'))
                            <img src="{{ $band->getFirstMediaUrl('band_photos') }}" alt="Foto {{ $band->name }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-slate-100">
                                <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 6l12-3">
                                    </path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-4 flex-grow flex flex-col">
                        <h2 class="text-lg font-bold text-slate-800">{{ $band->name }}</h2>
                        <p class="text-sm text-slate-500 mt-1">{{ $band->origin }}</p>
                        <div class="mt-3 pt-3 border-t border-slate-100 flex-grow">
                            <span
                                class="inline-block bg-indigo-100 text-indigo-800 text-xs font-semibold px-2 py-1 rounded-full">{{ $band->genre }}</span>
                        </div>
                        <div class="text-right text-sm font-semibold text-indigo-600 mt-2">
                            Profil &rarr;
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-span-full bg-white border border-slate-200 rounded-xl p-8 text-center">
                <p class="text-slate-500">Tidak ada band yang ditemukan.</p>
            </div>
        @endforelse
    </div>
    {{-- Paginasi --}}
    @if ($bands->hasPages())
        <div class="mt-8">
            {{ $bands->links() }}
        </div>
    @endif
</x-app-layout>
