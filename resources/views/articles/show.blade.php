<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <article>
            {{-- Header Artikel --}}
            <header class="mb-10">
                <a href="{{ route('articles.index') }}"
                    class="text-blue-600 text-sm hover:underline inline-flex items-center">
                    ← Kembali ke semua artikel
                </a>

                <h1 class="mt-4 text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                    {{ $article->title }}
                </h1>

                <div class="mt-4 text-sm text-gray-600 flex flex-wrap items-center gap-2">
                    <span>
                        Dipublikasikan pada {{ $article->published_at->format('d M Y') }} oleh
                        <strong>{{ $article->user->name }}</strong>
                    </span>

                    <span class="text-gray-400">•</span>

                    <span>
                        Kategori:
                        <a href="#" class="text-blue-600 font-medium hover:underline">
                            {{ $article->category->name }}
                        </a>
                    </span>
                </div>
            </header>

            {{-- Konten Artikel --}}
            <div class="prose prose-lg max-w-none text-gray-800">
                {!! $article->body !!}
            </div>

            {{-- Tags --}}
            @if ($article->tags->isNotEmpty())
                <div class="mt-10 pt-6 border-t border-gray-200">
                    <h2 class="text-base font-semibold text-gray-700 mb-3">Tag Terkait:</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($article->tags as $tag)
                            <span class="px-3 py-1 text-sm font-medium text-gray-700 bg-gray-100 rounded-full">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Komentar --}}
            <div class="mt-14">
                @livewire('comment.comment-section', ['article' => $article], key($article->id))
            </div>
        </article>
    </div>
</x-app-layout>
