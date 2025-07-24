{{-- resources/views/articles/partials/content.blade.php --}}

<header class="pb-6 border-b border-gray-200 dark:border-slate-700">
    {{-- 1. Badge Kategori di atas judul --}}
    <div class="mb-4">
        <a href="#" {{-- Ganti # dengan link ke halaman kategori --}}
            class="text-sm font-bold uppercase tracking-widest text-red-600 dark:text-sky-400 hover:text-red-800 dark:hover:text-sky-300 transition-colors">
            {{ $article->category->name }}
        </a>
    </div>

    {{-- Judul Artikel --}}
    <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 dark:text-slate-100 leading-tight">
        {{ $article->title }}
    </h1>

    {{-- 2. Blok Info Penulis yang Ditingkatkan --}}
    <div class="mt-6 flex items-center">
        <div class="flex-shrink-0">
            <a href="#"> {{-- Link ke profil penulis --}}
                {{-- Tampilkan avatar penulis. Jika tidak ada, gunakan placeholder. --}}
                <img class="h-14 w-14 rounded-full object-cover"
                    src="{{ $article->user->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($article->user->name) . '&color=FFFFFF&background=D1D5DB' }}"
                    alt="{{ $article->user->name }}">
            </a>
        </div>
        <div class="ml-4">
            <p class="text-base font-semibold text-gray-800 dark:text-slate-200">
                <a href="#" class="hover:underline">{{ $article->user->name }}</a>
            </p>
            <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-slate-400">
                <time datetime="{{ $article->published_at->toIso8601String() }}">
                    {{ $article->published_at->format('d F Y') }}
                </time>
                <span>&bull;</span>
                <span>{{ $article->getReadingTime() }} min read</span> {{-- Asumsi ada method getReadingTime() --}}
            </div>
        </div>
    </div>
</header>

{{-- Konten Body Artikel --}}
<div class="mt-8">
    {{-- Class 'prose' dan 'dark:prose-invert' di parent akan menangani styling di sini --}}
    {!! $article->body !!}
</div>

{{-- 3. Bagian Tag yang Stylish --}}
@if ($article->tags->isNotEmpty())
    <div class="mt-10 pt-6 border-t border-gray-200 dark:border-slate-700">
        <div class="flex flex-wrap items-center gap-3">
            <span class="font-semibold text-gray-800 dark:text-slate-200">Topik Terkait:</span>
            @foreach ($article->tags as $tag)
                <a href="#" {{-- Ganti # dengan link ke halaman tag --}}
                    class="bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 text-sm font-medium px-4 py-1.5 rounded-full transition-colors duration-300 hover:bg-red-100 dark:hover:bg-slate-600 hover:text-red-700 dark:hover:text-slate-100">
                    #{{ $tag->name }}
                </a>
            @endforeach
        </div>
    </div>
@endif
