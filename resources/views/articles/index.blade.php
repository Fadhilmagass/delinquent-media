<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold text-slate-800 leading-tight">
            Berita & Artikel
        </h1>
    </x-slot>

    {{-- Form Pencarian --}}
    <div class="mb-8">
        <form method="GET" action="{{ route('articles.index') }}">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" class="w-full rounded-md border-slate-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Cari artikel...">
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 p-2 rounded-full bg-indigo-600 text-white hover:bg-indigo-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($articles as $article)
            <div class="bg-white border border-slate-200 rounded-xl shadow-md overflow-hidden transform hover:-translate-y-1 transition-transform duration-300">
                <a href="{{ route('articles.show', $article) }}" class="block h-full flex flex-col">
                    <div class="p-6 flex-grow">
                        <span class="inline-block text-xs font-semibold text-indigo-600 uppercase tracking-wide">
                            {{ $article->category->name }}
                        </span>

                        <h2 class="mt-2 text-lg font-bold text-slate-800 group-hover:text-indigo-700 transition-colors">
                            {{ $article->title }}
                        </h2>

                        <p class="mt-3 text-sm text-slate-600 line-clamp-3">
                            {{ $article->excerpt }}
                        </p>
                    </div>

                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 text-sm text-slate-500">
                        <span>Oleh {{ $article->user->name }}</span>
                        <span class="mx-1">&bull;</span>
                        <span>{{ $article->published_at->diffForHumans() }}</span>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-span-full bg-white border border-slate-200 rounded-xl p-8 text-center">
                <p class="text-slate-500">
                    @if (request('search'))
                        Tidak ada artikel yang cocok dengan pencarian Anda.
                    @else
                        Belum ada artikel yang dipublikasikan.
                    @endif
                </p>
            </div>
        @endforelse
    </div>

    @if ($articles->hasPages())
        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    @endif
</x-app-layout>