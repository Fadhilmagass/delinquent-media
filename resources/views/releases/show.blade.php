{{-- resources/views/releases/show.blade.php --}}
<x-app-layout>
    <div class="container mx-auto p-4 md:p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            {{-- Kolom Kiri: Cover & Player --}}
            <div class="md:col-span-1">
                <img src="{{ $release->getFirstMediaUrl('release_covers') }}" alt="Cover {{ $release->title }}"
                    class="w-full rounded-lg shadow-lg mb-6" loading="lazy">

                {{-- Embed Player Logic --}}
                @if ($release->embed_url)
                    @php
                        $embedSrc = '';
                        if (str_contains($release->embed_url, 'spotify.com')) {
                            $embedSrc = $release->embed_url;
                            if (!str_contains($embedSrc, '?utm_source=oembed')) {
                                $embedSrc .= '?utm_source=oembed';
                            }
                        } elseif (str_contains($release->embed_url, 'bandcamp.com')) {
                            // Bandcamp embeds require a bit more work, usually finding the embed ID from the page source
                            // For simplicity, we'll just link to it. A more advanced solution could use an API or scraping.
                        }
                    @endphp

                    @if ($embedSrc)
                        <iframe style="border-radius:12px" src="{{ $embedSrc }}" width="100%" height="352"
                            frameBorder="0" allowfullscreen=""
                            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                            loading="lazy"></iframe>
                    @endif
                @endif
            </div>

            {{-- Kolom Kanan: Detail Rilisan --}}
            <div class="md:col-span-2">
                <h1 class="text-4xl font-extrabold">{{ $release->title }}</h1>
                <h2 class="text-2xl font-semibold mt-2">
                    oleh <a href="{{ route('bands.show', $release->band) }}"
                        class="text-red-600 hover:underline">{{ $release->band->name }}</a>
                </h2>
                <div class="mt-4 text-gray-500">
                    <span>{{ $release->type->value }}</span>
                    <span class="mx-2">&bull;</span>
                    <span>Dirilis pada {{ $release->release_date->format('d F Y') }}</span>
                </div>

                {{-- Placeholder untuk tracklist atau deskripsi rilisan --}}
                <div class="mt-8">
                    <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                        <x-heroicon-o-musical-note class="w-6 h-6 text-red-600" />
                        Tracklist
                    </h3>
                    @if ($release->tracks->count() > 0)
                        <ol class="space-y-2">
                            @foreach ($release->tracks->sortBy('track_number') as $track)
                                <li
                                    class="flex items-center gap-3 bg-gray-50 rounded px-4 py-2 shadow-sm hover:bg-gray-100 transition">
                                    <span
                                        class="font-mono text-gray-500 w-6 text-right">{{ $track->track_number }}.</span>
                                    <span class="flex-1 font-medium text-gray-800">{{ $track->title }}</span>
                                    @if ($track->duration)
                                        <span
                                            class="text-xs text-gray-500 bg-gray-200 rounded px-2 py-0.5 ml-2">{{ $track->duration }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    @else
                        <div class="flex items-center gap-2 text-gray-500 bg-gray-50 rounded px-4 py-3">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"></path>
                            </svg>
                            Tidak ada tracklist yang tersedia untuk rilis ini.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
