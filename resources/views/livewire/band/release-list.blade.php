<div class="space-y-4">
    @forelse ($releases as $release)
        <a href="{{ route('releases.show', $release) }}"
            class="release-item group relative cursor-pointer transition-all duration-300 block"
            style="--animation-delay: {{ $loop->index * 100 }}ms;" wire:key="{{ $release->id }}">
            <div
                class="flex items-center bg-white p-4 rounded-2xl shadow-lg border border-slate-100 h-full transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-2xl hover:border-sky-200">
                <div class="w-20 h-20 rounded-xl mr-5 overflow-hidden flex-shrink-0 shadow-lg relative">
                    @if ($release->hasMedia('release_covers'))
                        <img src="{{ $release->getFirstMediaUrl('release_covers') }}" alt="{{ $release->title }}"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105 group-hover:brightness-90">
                        <span class="absolute inset-0 rounded-xl bg-black/0 group-active:bg-black/10 transition"></span>
                    @else
                        <div
                            class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 19V6l13M9 6L3 12m6-6l6 6" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <p class="font-bold text-lg text-slate-800 truncate">{{ $release->title }}</p>
                    <div class="flex items-center text-sm text-slate-500 mt-1 space-x-2">
                        <span
                            class="font-semibold text-sky-600 px-2 py-0.5 bg-sky-100 rounded-md shadow-sm">{{ $release->type->value }}</span>
                        <span>&bull;</span>
                        <span>{{ $release->release_date->format('Y') }}</span>
                    </div>
                </div>
                <div class="ml-4 text-slate-300 flex items-center">
                    <button type="button" aria-label="View Details" class="tooltip relative focus:outline-none">
                        <svg class="w-6 h-6 group-hover:text-sky-500 transition" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <span
                            class="tooltip-text absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-slate-800 text-white text-xs rounded shadow opacity-0 group-hover:opacity-100 transition">View
                            Details</span>
                    </button>
                </div>
                <!-- Ripple effect -->
                <span class="absolute inset-0 pointer-events-none group-active:animate-ripple"></span>
            </div>
        </a>
    @empty
        <div class="text-center py-12 px-6 bg-white rounded-2xl shadow-lg border border-slate-100">
            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m-15.357-2a8.001 8.001 0 0115.357-2m0 0H15">
                </path>
            </svg>
            <h3 class="mt-2 text-lg font-semibold text-slate-800">No Releases Yet</h3>
            <p class="mt-1 text-sm text-slate-500">This band hasn't released any music yet.</p>
        </div>
    @endforelse

    @if ($releases->hasPages())
        <div class="mt-8">
            {{ $releases->links('vendor.pagination.tailwind') }}
        </div>
    @endif
</div>
<style>
    .release-item {
        opacity: 0;
        transform: translateX(20px);
        animation: item-fade-in 0.5s cubic-bezier(.4, 0, .2, 1) forwards;
        animation-delay: var(--animation-delay);
    }

    @keyframes item-fade-in {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Ripple effect */
    @keyframes ripple {
        0% {
            opacity: 0.4;
            transform: scale(0);
        }

        100% {
            opacity: 0;
            transform: scale(2);
        }
    }

    .animate-ripple {
        background: radial-gradient(circle, rgba(0, 172, 238, 0.2) 10%, transparent 70%);
        animation: ripple 0.5s linear;
    }

    /* Tooltip */
    .tooltip-text {
        pointer-events: none;
        z-index: 10;
    }
</style>
