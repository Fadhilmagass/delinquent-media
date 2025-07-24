@props(['event'])

<a href="{{ route('events.show', $event) }}"
    class="group bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 flex items-center gap-4 hover:shadow-lg hover:border-indigo-300 dark:hover:border-sky-500 transition-all duration-300">
    {{-- Lencana Tanggal --}}
    <div class="flex-shrink-0 text-center bg-gray-50 dark:bg-slate-700 rounded-lg p-3 border border-gray-200 dark:border-slate-600 w-20">
        <p class="text-sm font-bold text-indigo-600 dark:text-sky-400 uppercase">
            {{ $event->event_time->format('M') }}
        </p>
        <p class="text-3xl font-bold text-gray-800 dark:text-slate-200 tracking-tight">
            {{ $event->event_time->format('d') }}
        </p>
    </div>

    {{-- Info Acara --}}
    <div class="flex-1">
        <h3 class="font-bold text-gray-800 dark:text-slate-200 group-hover:text-indigo-600 dark:group-hover:text-sky-400 transition-colors duration-300">
            {{ $event->name }}
        </h3>
        <p class="text-sm text-gray-500 dark:text-slate-400">
            {{ $event->venue }}, {{ $event->city }}
        </p>
    </div>

    {{-- Lineup (Avatar) --}}
    <div class="hidden sm:flex -space-x-2 overflow-hidden">
        @foreach ($event->bands->take(3) as $band)
            <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white dark:ring-slate-800"
                src="{{ $band->getFirstMediaUrl('band_photos', 'avatar') }}" alt="{{ $band->name }}">
        @endforeach
        @if ($event->bands->count() > 3)
            <div
                class="h-8 w-8 rounded-full ring-2 ring-white dark:ring-slate-800 bg-gray-200 dark:bg-slate-600 flex items-center justify-center text-xs font-bold text-gray-600 dark:text-slate-200">
                +{{ $event->bands->count() - 3 }}
            </div>
        @endif
    </div>

    {{-- Panah --}}
    <div class="text-gray-400 dark:text-slate-500 group-hover:text-indigo-600 dark:group-hover:text-sky-400 transition-colors duration-300">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </div>
</a>
