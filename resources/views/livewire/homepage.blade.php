{{-- resources/views/livewire/homepage.blade.php --}}
<div class="space-y-24">

    {{-- HERO / Jumbotron --}}
    <section class="relative h-[32rem] bg-cover bg-center flex items-center justify-center text-white text-center"
        style="background-image: url('https://images.unsplash.com/photo-1516273836189-23a43c2b4e8e?q=80&w=2070');">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <div class="relative z-10 max-w-2xl px-4">
            <h1 class="text-5xl md:text-6xl font-extrabold drop-shadow-lg">Delinquent-ID</h1>
            <p class="mt-6 text-xl md:text-2xl drop-shadow-md">Portal Musik Keras Terdepan di Indonesia</p>
            <a href="#latest-articles"
                class="mt-8 inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg transition-transform transform hover:scale-105">Lihat
                Konten</a>
        </div>
    </section>

    {{-- Main Content Area --}}
    <div id="latest-articles" class="container mx-auto px-4 space-y-24">
        {{-- Bacaan Terbaru --}}
        <section>
            <h2 class="text-3xl font-bold mb-6 text-center text-slate-800 dark:text-slate-200">Bacaan Terbaru</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($latestArticles as $article)
                    <a href="{{ route('articles.show', $article) }}"
                        class="group block bg-white dark:bg-slate-800 shadow-lg rounded-lg overflow-hidden transition-transform transform hover:-translate-y-1">
                        <div class="h-48 bg-gray-300 dark:bg-slate-700 bg-cover bg-center"
                            style="background-image: url('{{ $article->getFirstMediaUrl('article_images') ?: 'https://via.placeholder.com/400x200' }}');">
                        </div>
                        <div class="p-4">
                            <span class="text-sm font-semibold text-red-600 dark:text-red-500">{{ $article->category?->name }}</span>
                            <h3 class="mt-1 font-bold text-lg text-slate-800 dark:text-slate-200 group-hover:text-red-600 dark:group-hover:text-red-500 transition">{{ $article->title }}
                            </h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        {{-- Acara Mendatang --}}
        <section>
            <h2 class="text-3xl font-bold mb-6 text-center text-slate-800 dark:text-slate-200">Acara Mendatang</h2>
            <div class="space-y-4">
                @forelse ($upcomingEvents as $event)
                    <a href="{{ route('events.show', $event) }}"
                        class="flex items-center bg-white dark:bg-slate-800 p-4 rounded-lg shadow-md hover:shadow-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-shadow">
                        <div class="text-center w-20 mr-4">
                            <p class="text-2xl font-bold text-red-600 dark:text-red-500">{{ $event->event_time->format('d') }}</p>
                            <p class="text-md text-slate-600 dark:text-slate-400">{{ $event->event_time->format('M') }}</p>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-lg text-slate-800 dark:text-slate-200">{{ $event->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-slate-400">{{ $event->venue }}, {{ $event->city }}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-center text-gray-500 dark:text-slate-400">Tidak ada jadwal acara.</p>
                @endforelse
            </div>
        </section>

        {{-- Rilisan Panas --}}
        <section>
            <h2 class="text-3xl font-bold mb-6 text-center text-slate-800 dark:text-slate-200">Rilisan Panas</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach ($latestReleases as $release)
                    <a href="{{ route('bands.show', $release->band) }}" class="group text-center">
                        <img src="{{ $release->getFirstMediaUrl('release_covers') ?: 'https://via.placeholder.com/150' }}"
                            alt="Cover {{ $release->title }}"
                            class="w-full aspect-square object-cover rounded-lg shadow-lg transform group-hover:-translate-y-1 transition-transform">
                        <h3 class="mt-2 font-semibold truncate text-slate-800 dark:text-slate-200">{{ $release->title }}</h3>
                        <p class="text-sm text-gray-500 dark:text-slate-400 truncate">{{ $release->band?->name }}</p>
                    </a>
                @endforeach
            </div>
        </section>

        {{-- Sorotan Band --}}
        <section>
            <h2 class="text-3xl font-bold mb-6 text-center text-slate-800 dark:text-slate-200">Sorotan Band</h2>
            <div class="flex flex-wrap justify-center gap-6">
                @if (isset($featuredBands) && count($featuredBands))
                    @foreach ($featuredBands as $band)
                        <a href="{{ route('bands.show', $band) }}" class="text-center group">
                            <img src="{{ $band->getFirstMediaUrl('band_photos') ?: 'https://via.placeholder.com/150' }}"
                                alt="Foto {{ $band->name }}"
                                class="w-32 h-32 object-cover rounded-full shadow-lg border-4 border-white dark:border-slate-800 transform group-hover:scale-110 transition-transform">
                            <p class="mt-2 font-semibold text-slate-800 dark:text-slate-200">{{ $band->name }}</p>
                        </a>
                    @endforeach
                @else
                    <p class="text-center text-gray-500 dark:text-slate-400">Tidak ada band yang disorot.</p>
                @endif
            </div>
        </section>

        {{-- CTA Section --}}
        <section class="bg-red-600 text-white rounded-lg text-center p-10">
            <h2 class="text-2xl md:text-3xl font-bold">Ingin jadi bagian dari komunitas musik keras?</h2>
            <p class="mt-2">Gabung bersama kami di forum Delinquent.ID dan mulai berdiskusi!</p>
            <a href="{{ route('login') }}"
                class="mt-6 inline-block bg-white text-red-600 font-bold px-6 py-3 rounded-lg hover:bg-gray-100 transition">Masuk
                ke Forum</a>
        </section>

        {{-- Footer --}}
        <footer class="border-t border-slate-200 dark:border-slate-800 mt-24 pt-10 text-center text-gray-500 dark:text-slate-400 text-sm">
            &copy; {{ date('Y') }} Delinquent.ID — Musik Keras Untuk Semua. Made with 🤘 in Indonesia.
        </footer>
    </div>
</div>
