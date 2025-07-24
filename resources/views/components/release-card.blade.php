@props(['release'])

<a href="{{ route('releases.show', ['band' => $release->band, 'release' => $release]) }}" class="group text-center">
    <div
        class="relative rounded-lg overflow-hidden shadow-md dark:shadow-slate-900 transform group-hover:-translate-y-1 group-hover:shadow-xl transition-all duration-300">
        <img src="{{ $release->getFirstMediaUrl('cover', 'preview') }}" alt="Cover {{ $release->title }}"
            class="w-full aspect-square object-cover">
        <div
            class="absolute inset-0 bg-black/20 dark:bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>
    <h4 class="mt-2 font-bold text-sm text-gray-800 dark:text-slate-200 truncate group-hover:text-indigo-600 dark:group-hover:text-sky-400">
        {{ $release->title }}
    </h4>
    <p class="text-xs text-gray-500 dark:text-slate-400 truncate">
        {{ $release->band->name }}
    </p>
</a>
