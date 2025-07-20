@props(['article'])

<a href="{{ route('articles.show', $article) }}"
    class="group bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col">
    @if ($article->hasMedia('cover'))
        <img src="{{ $article->getFirstMediaUrl('cover', 'preview') }}" alt="{{ $article->title }}"
            class="w-full h-40 object-cover">
    @else
        <div class="w-full h-40 bg-gray-200 flex items-center justify-center">
            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h7" />
            </svg>
        </div>
    @endif
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-lg font-bold text-gray-800 group-hover:text-indigo-600 transition-colors duration-300">
            {{ $article->title }}
        </h3>
        <p class="text-sm text-gray-500 mt-2 flex-grow">
            {{ Str::limit($article->excerpt, 100) }}
        </p>
        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
            <span>{{ $article->category->name }}</span>
            <span>{{ $article->published_at->diffForHumans() }}</span>
        </div>
    </div>
</a>
