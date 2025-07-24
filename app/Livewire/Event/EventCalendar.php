<?php

namespace App\Livewire\Event;

use App\Models\Band;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;

class EventCalendar extends Component
{
    use WithPagination;

    // Properti untuk filter
    public string $selectedCity = '';
    public string $selectedMonth = '';
    public string $selectedGenre = '';

    // Properti untuk view
    public string $viewMode = 'list'; // 'list' atau 'calendar'
    public array $eventsForCalendar = [];

    // Properti untuk data filter dropdown
    public array $cities = [];
    public array $genres = [];
    public array $months = [];

    public function mount()
    {
        // Mengisi data untuk dropdown filter saat komponen pertama kali dimuat
        $this->cities = Cache::remember('event_cities', now()->addHour(), function () {
            return Event::select('city')->distinct()->orderBy('city')->pluck('city')->toArray();
        });

        $this->genres = Cache::remember('band_genres', now()->addHour(), function () {
            return Band::select('genre')->distinct()->whereNotNull('genre')->orderBy('genre')->pluck('genre')->toArray();
        });

        // Membuat daftar bulan untuk filter (6 bulan ke depan)
        for ($i = 0; $i < 6; $i++) {
            $date = Carbon::now()->addMonths($i);
            $this->months[$date->format('Y-m')] = $date->format('F Y');
        }
    }

    // Dipanggil setiap kali filter berubah
    public function updated()
    {
        $this->resetPage(); // Reset paginasi saat filter berubah
    }

    public function render()
    {
        $query = Event::query()
            ->where('event_time', '>=', now())
            ->with('bands');

        if ($this->selectedCity) {
            $query->where('city', $this->selectedCity);
        }

        if ($this->selectedMonth) {
            $query->whereYear('event_time', Carbon::parse($this->selectedMonth)->year)
                ->whereMonth('event_time', Carbon::parse($this->selectedMonth)->month);
        }

        if ($this->selectedGenre) {
            $query->whereHas('bands', function ($q) {
                $q->where('genre', $this->selectedGenre);
            });
        }

        if ($this->viewMode === 'list') {
            $currentPage = $this->getPage();
            $cacheKey = 'events-list-' . $this->selectedCity . '-' . $this->selectedMonth . '-' . $this->selectedGenre . '-page-' . $currentPage;
            $events = Cache::remember($cacheKey, now()->addMinutes(15), function () use ($query) {
                return $query->orderBy('event_time', 'asc')->paginate(10);
            });
        } else {
            $cacheKey = 'events-calendar-' . $this->selectedCity . '-' . $this->selectedMonth . '-' . $this->selectedGenre;
            $events = Cache::remember($cacheKey, now()->addMinutes(15), function () use ($query) {
                return $query->orderBy('event_time', 'asc')->get();
            });
            $this->formatEventsForCalendar($events);
            $this->dispatch('eventsUpdated', $this->eventsForCalendar);
        }

        return view('livewire.event.event-calendar', [
            'events' => $events,
        ]);
    }

    public function resetFilters()
    {
        $this->reset('selectedCity', 'selectedMonth', 'selectedGenre');
    }

    // Method untuk mengubah view
    public function setViewMode(string $mode)
    {
        $this->viewMode = $mode;
        $this->resetPage();
    }

    // Method untuk memformat data agar bisa dibaca oleh FullCalendar.js
    private function formatEventsForCalendar($events)
    {
        $this->eventsForCalendar = $events->map(function ($event) {
            return [
                'title' => $event->name,
                'start' => $event->event_time->toIso8601String(),
                'url' => route('events.show', $event),
                // Data tambahan untuk tooltip
                'extendedProps' => [
                    'venue' => $event->venue,
                    'city' => $event->city,
                    'bands' => $event->bands->pluck('name')->implode(', '),
                ],
            ];
        })->toArray();
    }
}
