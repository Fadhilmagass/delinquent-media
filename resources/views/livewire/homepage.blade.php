<div class="space-y-24">

    {{-- Hero Section --}}
    <section class="relative h-[28rem] bg-gray-900 bg-cover bg-center"
        style="background-image: url('https://images.unsplash.com/photo-1516273836189-23a43c2b4e8e?q=80&w=2070');">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-4">
            <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight">Delinquent-ID</h1>
            <p class="mt-4 text-lg md:text-xl max-w-2xl">Portal Musik Keras Terdepan di Indonesia: Berita, Ulasan, dan
                Arsip Digital.</p>
        </div>
    </section>

    <div class="container mx-auto px-4 space-y-24">

        {{-- Bacaan Terbaru --}}
        <section>
            <h2 class="text-3xl font-extrabold mb-6 tracking-tight text-gray-900">Bacaan Terbaru</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($latestArticles as $article)
                    <a href="{{ route('articles.show', $article) }}"
                        class="group block bg-white shadow-md rounded-xl overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="h-48 bg-gray-200 group-hover:brightness-95 transition-all"></div>
                        <div class="p-4">
                            <span
                                class="text-sm font-medium text-red-600 uppercase">{{ $article->category->name }}</span>
                            <h3 class="mt-1 text-lg font-semibold text-gray-800 group-hover:text-red-600 transition">
                                {{ $article->title }}
                            </h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        {{-- Acara Mendatang --}}
        <section>
            <h2 class="text-3xl font-extrabold mb-6 tracking-tight text-gray-900">Acara Mendatang</h2>
            <div class="space-y-4">
                @forelse ($upcomingEvents as $event)
                    <a href="{{ route('events.show', $event) }}"
                        class="flex items-center bg-white p-4 rounded-xl shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <div class="text-center w-20 mr-4">
                            <p class="text-3xl font-bold text-red-600">{{ $event->event_time->format('d') }}</p>
                            <p class="text-sm uppercase tracking-widest text-gray-700">
                                {{ $event->event_time->format('M') }}</p>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $event->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $event->venue }}, {{ $event->city }}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-center text-gray-500 italic">Tidak ada jadwal acara.</p>
                @endforelse
            </div>
        </section>

        {{-- Rilisan Panas --}}
        <section>
            <h2 class="text-3xl font-extrabold mb-6 tracking-tight text-gray-900">Rilisan Panas</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach ($latestReleases as $release)
                    <a href="{{ route('bands.show', $release->band) }}" class="group text-center">
                        <img src="{{ $release->getFirstMediaUrl('release_covers') ?: 'https://via.placeholder.com/150' }}"
                            alt="Cover {{ $release->title }}"
                            class="w-full aspect-square object-cover rounded-lg shadow-lg transform group-hover:-translate-y-1 transition-transform duration-300">
                        <h3 class="mt-2 font-semibold text-gray-800 truncate">{{ $release->title }}</h3>
                        <p class="text-sm text-gray-500 truncate">{{ $release->band->name }}</p>
                    </a>
                @endforeach
            </div>
        </section>

        {{-- Sorotan Band --}}
        <section>
            <h2 class="text-3xl font-extrabold mb-6 tracking-tight text-gray-900">Sorotan Band</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 justify-items-center">
                @foreach ($featuredBands as $band)
                    <a href="{{ route('bands.show', $band) }}" class="flex flex-col items-center group">
                        <img src="{{ $band->getFirstMediaUrl('band_photos') ?: 'https://via.placeholder.com/150' }}"
                            alt="Foto {{ $band->name }}"
                            class="w-32 h-32 object-cover rounded-full shadow-md border-4 border-white transform group-hover:scale-110 transition-transform duration-300">
                        <p class="mt-2 font-semibold text-gray-800 text-center truncate w-32">{{ $band->name }}</p>
                    </a>
                @endforeach
            </div>
        </section>

    </div>
</div>
