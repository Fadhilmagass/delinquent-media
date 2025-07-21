<x-app-layout>
    {{-- Latar belakang halaman --}}
    <div class="bg-slate-50 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- 1. Hero Banner & Profile Header --}}
            <div class="relative h-48 md:h-56 rounded-2xl bg-gradient-to-r from-slate-800 to-slate-600">
                {{-- Gambar banner band, dengan overlay gelap untuk kontras teks --}}
                @if ($band->hasMedia('band_photos'))
                    <img src="{{ $band->getFirstMediaUrl('band_photos') }}" alt="Foto {{ $band->name }}"
                        class="w-full h-full object-cover rounded-2xl opacity-40">
                @endif
                <div class="absolute inset-0 p-6 flex flex-col justify-end">
                    <h1 class="text-4xl lg:text-5xl font-extrabold text-white tracking-tight">
                        {{ $band->name }}
                    </h1>
                    <p class="text-slate-300 mt-1 text-lg">{{ $band->origin }}</p>
                </div>
                <a href="{{ route('bands.index') }}"
                    class="absolute top-4 right-4 text-sm font-semibold text-white bg-black bg-opacity-20 px-3 py-1.5 rounded-lg transition hover:bg-opacity-40">
                    &larr; Kembali
                </a>
            </div>

            <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Kolom Kiri: Foto & Info --}}
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white border border-slate-200 rounded-xl shadow-lg">
                        <div class="p-6">
                            {{-- 2. Info Detail & Ikon Sosial Media Terpusat --}}
                            <div class="flex items-center gap-2">
                                <span
                                    class="inline-block bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full">
                                    {{ $band->genre }}
                                </span>
                            </div>

                            <div class="mt-4 flex items-center space-x-4">
                                {{-- Tautan Website --}}
                                @if ($band->website_url)
                                    <a href="{{ $band->website_url }}" target="_blank"
                                        class="text-gray-500 transition-all duration-300 hover:text-red-600 hover:scale-110 transform">
                                        <span class="sr-only">Website</span>
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
                                        </svg>
                                    </a>
                                @endif
                                {{-- Tautan Bandcamp --}}
                                @if ($band->bandcamp_url)
                                    <a href="{{ $band->bandcamp_url }}" target="_blank"
                                        class="text-gray-500 transition-all duration-300 hover:text-red-600 hover:scale-110 transform">
                                        <span class="sr-only">Bandcamp</span>
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 18.75h24v-7.5H0v7.5zM12 4.5L18.75 15H5.25L12 4.5z" />
                                        </svg>
                                    </a>
                                @endif
                                {{-- Tautan Spotify --}}
                                @if ($band->spotify_url)
                                    <a href="{{ $band->spotify_url }}" target="_blank"
                                        class="text-gray-500 transition-all duration-300 hover:text-red-600 hover:scale-110 transform">
                                        <span class="sr-only">Spotify</span>
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 2.25C6.634 2.25 2.25 6.634 2.25 12S6.634 21.75 12 21.75 21.75 17.366 21.75 12 17.366 2.25 12 2.25zm4.355 14.12a.75.75 0 01-1.03.27c-2.82-1.73-6.38-2.12-10.57-1.17a.75.75 0 01-.32-1.47c4.54-1 8.47-.57 11.6 1.27a.75.75 0 01.27 1.1zm1.47-2.67a.939.939 0 01-1.29.34c-3.23-2-8.16-2.57-11.98-1.42a.94.94 0 11-.54-1.8c4.23-1.27 9.57-.64 13.23 1.62a.939.939 0 01.34 1.26zm.13-2.81c-3.7-2.19-9.85-2.39-13.36-1.32a1.126 1.126 0 11-.65-2.17c4.01-1.2 10.77-.97 14.93 1.46a1.126 1.126 0 11-1.12 1.97z" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- 3. Tombol Aksi Admin dengan Ikon --}}
                        @role('admin')
                            <div class="bg-slate-50 border-t border-slate-200 px-6 py-4 flex gap-3 rounded-b-xl">
                                <a href="{{ route('bands.edit', $band) }}"
                                    class="flex-1 text-center px-4 py-2 bg-amber-500 text-white text-sm font-semibold rounded-lg hover:bg-amber-600 transition-colors flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.536L16.732 3.732z">
                                        </path>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('bands.destroy', $band) }}" method="POST" class="flex-1"
                                    onsubmit="return confirm('Anda yakin ingin menghapus band ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full text-center px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700 transition-colors flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        @endrole
                    </div>
                </div>

                {{-- Kolom Kanan: Konten dengan Tab --}}
                <div class="lg:col-span-2">
                    {{-- 4. Konten dengan Navigasi Tab --}}
                    <div>
                        <div class="border-b border-gray-200">
                            <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                                <button onclick="changeTab(event, 'bio')" class="tab-button active">Biografi</button>
                                <button onclick="changeTab(event, 'releases')" class="tab-button">Diskografi</button>
                            </nav>
                        </div>

                        <div class="mt-5">
                            <div id="bio" class="tab-panel">
                                <div class="bg-white border border-slate-200 rounded-xl shadow-lg p-6">
                                    <div class="prose max-w-none text-slate-600">
                                        {!! $band->bio ?: '<p class="text-slate-400 italic">Biografi belum tersedia.</p>' !!}
                                    </div>
                                </div>
                            </div>
                            <div id="releases" class="tab-panel" style="display: none;">
                                @livewire('band.release-list', ['band' => $band], key($band->id))
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .tab-button {
                @apply whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300;
            }

            .tab-button.active {
                @apply border-red-500 text-red-600;
            }
        </style>
    @endpush

    @push('scripts')
        {{-- 5. JavaScript untuk mengontrol Tab --}}
        <script>
            function changeTab(event, tabID) {
                // Sembunyikan semua panel tab
                document.querySelectorAll('.tab-panel').forEach(function(panel) {
                    panel.style.display = 'none';
                });

                // Hapus status aktif dari semua tombol tab
                document.querySelectorAll('.tab-button').forEach(function(button) {
                    button.classList.remove('active');
                });

                // Tampilkan panel tab yang dipilih
                document.getElementById(tabID).style.display = 'block';

                // Tandai tombol tab yang diklik sebagai aktif
                event.currentTarget.classList.add('active');
            }

            // Atur tab default agar aktif saat halaman dimuat
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('.tab-button').click();
            });
        </script>
    @endpush

</x-app-layout>
