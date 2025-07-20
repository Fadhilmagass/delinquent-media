{{-- resources/views/bands/show.blade.php --}}
<x-app-layout>
    <div class="bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200">

        {{-- Hero Section --}}
        <div class="relative h-80 md:h-96 overflow-hidden">
            {{-- Background Image --}}
            @if ($band->hasMedia('band_photos'))
                <img src="{{ $band->getFirstMediaUrl('band_photos') }}" alt="Foto {{ $band->name }}"
                    class="w-full h-full object-cover object-center">
            @else
                <div class="w-full h-full bg-gradient-to-br from-slate-300 to-slate-400 dark:from-slate-800 dark:to-slate-900"></div>
            @endif
            
            {{-- Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/50 to-transparent"></div>

            {{-- Content --}}
            <div class="absolute inset-0 flex flex-col justify-end p-6 md:p-12">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="show-content-translate-up">
                        <span class="text-sm font-semibold bg-sky-500 text-white px-3 py-1 rounded-full">{{ $band->genre }}</span>
                        <h1 class="text-4xl md:text-6xl font-extrabold text-white mt-2 shadow-lg tracking-tight">
                            {{ $band->name }}
                        </h1>
                        <p class="text-lg text-sky-200 mt-2 flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                            {{ $band->origin }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                {{-- Main Content (Bio & Discography) --}}
                <div class="lg:col-span-2">
                    {{-- Breadcrumb & Back Button --}}
                    <div class="mb-6 show-content-fade-in" style="--animation-delay: 100ms;">
                        <a href="{{ route('bands.index') }}"
                            class="inline-flex items-center text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-sky-600 transition-colors">
                            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                            <span>Back to Directory</span>
                        </a>
                    </div>

                    {{-- Biography --}}
                    <div class="prose prose-lg dark:prose-invert max-w-none show-content-fade-in" style="--animation-delay: 200ms;">
                        <p class="lead">{{ $band->bio }}</p>
                        {{-- You can add more detailed bio content here if available --}}
                    </div>

                    {{-- Discography --}}
                    <div class="mt-16 show-content-fade-in" style="--animation-delay: 300ms;">
                        <h2 class="text-3xl font-bold text-slate-800 border-b-2 border-sky-500 pb-3 mb-8 flex items-center gap-3">
                            <svg class="h-8 w-8 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l13M9 6L3 12m6-6l6 6"/></svg>
                            Discography
                        </h2>
                        @livewire('band.release-list', ['band' => $band], key($band->id))
                    </div>
                </div>

                {{-- Sticky Sidebar --}}
                <div class="lg:col-span-1">
                    <div class="sticky top-24 show-content-fade-in" style="--animation-delay: 400ms;">
                        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6 border border-slate-200 dark:border-slate-700">
                            <h3 class="text-xl font-semibold mb-4">Band Info</h3>
                            <ul class="space-y-3 text-sm">
                                <li class="flex justify-between">
                                    <span class="font-medium text-slate-500 dark:text-slate-400">Genre</span>
                                    <span class="font-bold">{{ $band->genre }}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="font-medium text-slate-500 dark:text-slate-400">Origin</span>
                                    <span class="font-bold">{{ $band->origin }}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="font-medium text-slate-500 dark:text-slate-400">Releases</span>
                                    <span class="font-bold">{{ $band->releases->count() }}</span>
                                </li>
                            </ul>

                            @role('admin')
                                <div class="border-t border-slate-200 dark:border-slate-700 mt-6 pt-6 flex gap-3">
                                    <a href="{{ route('bands.edit', $band) }}"
                                        class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-amber-500 text-white font-semibold shadow-md hover:bg-amber-600 hover:scale-105 transition-all duration-300">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L15.232 5.232z" /></svg>
                                        <span>Edit</span>
                                    </a>
                                    <form action="{{ route('bands.destroy', $band) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this band? This action cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-red-600 text-white font-semibold shadow-md hover:bg-red-700 hover:scale-105 transition-all duration-300">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            <span>Delete</span>
                                        </button>
                                    </form>
                                </div>
                            @endrole
                        </div>
                    </div>
                </div>

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