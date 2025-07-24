@php
    $user = Auth::user();
@endphp

<nav x-data="{ open: false }"
    class="bg-white dark:bg-slate-800 border-b border-gray-100 dark:border-slate-700 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            {{-- Logo & Navigasi Kiri --}}
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-slate-200" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-navigation-links />
                </div>
            </div>

            {{-- Navigasi Kanan --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-600 dark:text-slate-300 bg-white dark:bg-slate-800 hover:text-gray-800 dark:hover:text-slate-200 focus:outline-none transition ease-in-out duration-150">
                                <div x-data="{ name: '{{ $user->name }}' }" x-text="name"
                                    x-on:profile-updated.window="name = $event.detail.name">
                                </div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile')" wire:navigate>
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <livewire:logout-button />
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-medium text-gray-600 dark:text-slate-300 hover:text-gray-800 dark:hover:text-slate-200"
                        wire:navigate>{{ __('Log in') }}</a>
                    <a href="{{ route('register') }}"
                        class="ms-4 text-sm font-medium text-gray-600 dark:text-slate-300 hover:text-gray-800 dark:hover:text-slate-200"
                        wire:navigate>{{ __('Register') }}</a>
                @endauth

                {{-- Tombol Toggle Dark Mode --}}
                <div class="ms-4">
                    <button x-on:click="$store.theme.toggle()" aria-label="Toggle Dark Mode"
                        class="p-2 rounded-full bg-slate-200 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors duration-300">
                        <x-icon.sun class="h-5 w-5 block dark:hidden" />
                        <x-icon.moon class="h-5 w-5 hidden dark:block" />
                    </button>
                </div>
            </div>

            {{-- Menu Toggle Mobile --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 dark:text-slate-300 hover:text-gray-800 dark:hover:text-slate-200 hover:bg-gray-100 dark:hover:bg-slate-700 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Responsive Mobile Navigation --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform -translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-2" class="sm:hidden bg-white dark:bg-slate-800"
        style="display: none;">
        <div class="pt-2 pb-3 space-y-1">
            <x-navigation-links responsive />
        </div>

        @auth
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-slate-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-slate-200" x-data="{ name: '{{ $user->name }}' }"
                        x-text="name" x-on:profile-updated.window="name = $event.detail.name">
                    </div>
                    <div class="font-medium text-sm text-gray-500 dark:text-slate-400">{{ $user->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile')" wire:navigate>
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <livewire:logout-button />
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-slate-600">
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')" wire:navigate>
                        {{ __('Log in') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" wire:navigate>
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @endauth
    </div>
</nav>
