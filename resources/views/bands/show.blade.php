<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h1 class="text-3xl font-bold text-slate-800 leading-tight">
                    {{ $band->name }}
                </h1>
                <p class="text-slate-500 mt-1">Profil Band</p>
            </div>
            <a href="{{ route('bands.index') }}"
                class="mt-4 md:mt-0 text-sm font-semibold text-indigo-600 hover:text-indigo-700">&larr; Kembali ke
                direktori</a>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Kolom Kiri: Foto & Info --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white border border-slate-200 rounded-xl shadow-md">
                <div class="h-64 bg-slate-200 rounded-t-xl">
                    @if ($band->hasMedia('band_photos'))
                        <img src="{{ $band->getFirstMediaUrl('band_photos') }}" alt="Foto {{ $band->name }}"
                            class="w-full h-full object-cover rounded-t-xl">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-slate-100 rounded-t-xl">
                            <svg class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 6l12-3">
                                </path>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-slate-800">{{ $band->name }}</h2>
                    <p class="text-slate-500 mt-1">{{ $band->origin }}</p>
                    <div class="mt-4 pt-4 border-t border-slate-200">
                        <span
                            class="inline-block bg-indigo-100 text-indigo-800 text-sm font-semibold px-3 py-1 rounded-full">{{ $band->genre }}</span>
                    </div>
                </div>
                @role('admin')
                    <div class="bg-slate-50 border-t border-slate-200 px-6 py-4 flex gap-3 rounded-b-xl">
                        <a href="{{ route('bands.edit', $band) }}"
                            class="flex-1 text-center px-4 py-2 bg-amber-500 text-white text-sm font-semibold rounded-lg hover:bg-amber-600 transition-colors">Edit</a>
                        <form action="{{ route('bands.destroy', $band) }}" method="POST" class="flex-1"
                            onsubmit="return confirm('Anda yakin ingin menghapus band ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full text-center px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700 transition-colors">Hapus</button>
                        </form>
                    </div>
                @endrole
            </div>
        </div>

        {{-- Kolom Kanan: Bio & Rilisan --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white border border-slate-200 rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-slate-800 mb-4">Biografi</h2>
                <div class="prose max-w-none text-slate-600">
                    {{ $band->bio ?: 'Biografi belum tersedia.' }}
                </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl shadow-md">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-slate-800 mb-4">Diskografi</h2>
                </div>
                {{-- Komponen Livewire untuk daftar rilis --}}
                @livewire('band.release-list', ['band' => $band], key($band->id))
            </div>
        </div>
    </div>
</x-app-layout>
