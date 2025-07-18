<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-4xl font-extrabold text-center text-gray-900 mb-12">
            Berita & Artikel Terbaru
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($articles as $article)
                <a href="{{ route('articles.show', $article) }}"
                    class="group block bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                    <div class="p-6">
                        <span class="inline-block text-xs font-semibold text-blue-600 uppercase tracking-wide">
                            {{ $article->category->name }}
                        </span>

                        <h2 class="mt-2 text-lg font-bold text-gray-900 group-hover:underline">
                            {{ $article->title }}
                        </h2>

                        <p class="mt-3 text-sm text-gray-700 line-clamp-3">
                            {{ $article->excerpt }}
                        </p>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 text-sm text-gray-600">
                        <span>By {{ $article->user->name }}</span>
                        <span class="mx-1">&bull;</span>
                        <span>{{ $article->published_at->format('d M Y') }}</span>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-16">
                    <p class="text-gray-500 text-lg">Belum ada artikel yang dipublikasikan.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $articles->links() }}
        </div>
    </div>
</x-app-layout>
