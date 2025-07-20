{{-- resources/views/releases/show.blade.php --}}
<x-app-layout>
    <div class="bg-slate-50 text-slate-800">

        {{-- Hero Section --}}
        <div class="relative h-80 md:h-96 overflow-hidden">
            @if ($release->hasMedia('release_covers'))
                <img src="{{ $release->getFirstMediaUrl('release_covers') }}" alt="Cover for {{ $release->title }}"
                    class="w-full h-full object-cover object-center">
            @else
                <div class="w-full h-full bg-gradient-to-br from-slate-300 to-slate-400">
                </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/50 to-transparent"></div>
            <div class="absolute inset-0 flex flex-col justify-end p-6 md:p-12">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="show-content-translate-up">
                        <a href="{{ route('bands.show', $release->band) }}"
                            class="text-lg font-bold text-sky-300 hover:text-sky-100 transition-colors">{{ $release->band->name }}</a>
                        <h1 class="text-4xl md:text-6xl font-extrabold text-white mt-1 shadow-lg tracking-tight">
                            {{ $release->title }}
                        </h1>
                        <p class="text-lg text-sky-200 mt-2">
                            {{ $release->type->value }} &bull; {{ $release->release_date->format('F j, Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            {{-- Breadcrumb & Back Button --}}
            <div class="mb-8 show-content-fade-in" style="--animation-delay: 100ms;">
                <a href="{{ route('bands.show', $release->band) }}"
                    class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-sky-600 transition-colors">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Back to {{ $release->band->name }}</span>
                </a>
            </div>

            {{-- Tracklist --}}
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200">
                <div class="p-6 border-b border-slate-200">
                    <h2 class="text-2xl font-bold">Tracklist</h2>
                </div>
                <ul class="divide-y divide-slate-200">
                    @forelse ($release->tracks as $track)
                        <li class="flex items-center justify-between p-4 hover:bg-slate-50 transition-colors">
                            <div class="flex items-center">
                                <span class="text-slate-400 w-8 text-center">{{ $track->track_number }}</span>
                                <p class="font-semibold ml-4">{{ $track->title }}</p>
                            </div>
                            <span class="text-sm text-slate-500">{{ $track->duration }}</span>
                        </li>
                    @empty
                        <li class="p-6 text-center text-slate-500">
                            The tracklist for this release has not been added yet.
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
    <style>
        .show-content-translate-up {
            animation: content-translate-up 0.6s ease-out forwards;
        }

        .show-content-fade-in {
            opacity: 0;
            animation: content-fade-in 0.6s ease-out forwards;
            animation-delay: var(--animation-delay, 0s);
        }

        @keyframes content-translate-up {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes content-fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</x-app-layout>
