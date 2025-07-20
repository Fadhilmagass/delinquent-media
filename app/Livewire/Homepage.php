<?php

// app/Livewire/Homepage.php
namespace App\Livewire;

use App\Models\Article;
use App\Models\Band;
use App\Models\Event;
use App\Models\Release;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Homepage extends Component
{
    public function render()
    {
        // Cache semua query selama 1 jam (3600 detik)
        $cacheDuration = 3600;

        $latestArticles = Cache::remember('homepage_latest_articles', $cacheDuration, function () {
            return Article::with(['category', 'user'])
                ->where('status', 'published')
                ->latest('published_at')
                ->limit(4)
                ->get();
        });

        $upcomingEvents = Cache::remember('homepage_upcoming_events', $cacheDuration, function () {
            return Event::where('event_time', '>=', now())
                ->orderBy('event_time', 'asc')
                ->limit(3)
                ->get();
        });

        $latestReleases = Cache::remember('homepage_latest_releases', $cacheDuration, function () {
            return Release::with(['band', 'media'])
                ->latest('release_date')
                ->limit(6)
                ->get();
        });

        $featuredBands = Cache::remember('homepage_featured_bands', $cacheDuration, function () {
            // Mengambil band secara acak. Anda bisa ganti logikanya nanti
            return Band::with('media')->inRandomOrder()->limit(5)->get();
        });

        return view('livewire.homepage', [
            'latestArticles' => $latestArticles,
            'upcomingEvents' => $upcomingEvents,
            'latestReleases' => $latestReleases,
            'featuredBands' => $featuredBands,
        ])->layout('layouts.app');
    }
}
