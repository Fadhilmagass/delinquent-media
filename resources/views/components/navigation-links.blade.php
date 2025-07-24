@props(['responsive' => false])

@php
    $navClass = $responsive ? 'responsive-nav-link' : 'nav-link';
@endphp

@role('admin|editor')
    <x-dynamic-component :component="$navClass" :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
        {{ __('Dashboard') }}
    </x-dynamic-component>
@endrole

<x-dynamic-component :component="$navClass" :href="route('home')" :active="request()->routeIs('home')" wire:navigate>
    {{ __('Home') }}
</x-dynamic-component>

<x-dynamic-component :component="$navClass" :href="route('articles.index')" :active="request()->routeIs('articles.index')" wire:navigate>
    {{ __('Artikel') }}
</x-dynamic-component>

<x-dynamic-component :component="$navClass" :href="route('events.index')" :active="request()->routeIs('events.index')" wire:navigate>
    {{ __('Event') }}
</x-dynamic-component>
