<div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-xl p-6">
    <h3 class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-5 border-l-4 border-red-500 dark:border-sky-500 pl-4">
        Segera Hadir
    </h3>
    <div class="space-y-6">
        @forelse ($upcomingEvents as $event)
            <div class="flex items-start gap-4">
                <div class="text-center flex-shrink-0">
                    <p class="text-red-600 dark:text-sky-400 font-bold text-lg">{{ $event->event_time->format('d') }}</p>
                    <p class="text-slate-500 dark:text-slate-400 text-sm uppercase">{{ $event->event_time->format('M') }}</p>
                </div>
                <div>
                    <p class="font-bold text-slate-900 dark:text-slate-200 hover:text-red-700 dark:hover:text-sky-400 transition-colors">
                        <a href="{{ route('events.show', $event) }}">{{ $event->name }}</a>
                    </p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">{{ $event->venue }}, {{ $event->city }}</p>
                </div>
            </div>
        @empty
            <p class="text-slate-500 dark:text-slate-400 text-sm">Tidak ada acara mendatang.</p>
        @endforelse
    </div>
</div>