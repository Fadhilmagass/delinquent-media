<div class="bg-white border border-slate-200 rounded-2xl shadow-xl p-6">
    <h3 class="text-xl font-bold text-slate-800 mb-5 border-l-4 border-red-500 pl-4">
        Segera Hadir
    </h3>
    <div class="space-y-6">
        @forelse ($upcomingEvents as $event)
            <div class="flex items-start gap-4">
                <div class="text-center flex-shrink-0">
                    <p class="text-red-600 font-bold text-lg">{{ $event->event_time->format('d') }}</p>
                    <p class="text-slate-500 text-sm uppercase">{{ $event->event_time->format('M') }}</p>
                </div>
                <div>
                    <p class="font-bold text-slate-900 hover:text-red-700 transition-colors">
                        <a href="{{ route('events.show', $event) }}">{{ $event->name }}</a>
                    </p>
                    <p class="text-sm text-slate-500">{{ $event->venue }}, {{ $event->city }}</p>
                </div>
            </div>
        @empty
            <p class="text-slate-500 text-sm">Tidak ada acara mendatang.</p>
        @endforelse
    </div>
</div>