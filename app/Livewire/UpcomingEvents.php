<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class UpcomingEvents extends Component
{
    public $upcomingEvents;

    public function mount()
    {
        $this->loadUpcomingEvents();
    }

    public function loadUpcomingEvents()
    {
        $this->upcomingEvents = Event::where('event_time', '>=', now())
                                    ->orderBy('event_time', 'asc')
                                    ->limit(3)
                                    ->get();
    }

    public function render()
    {
        return view('livewire.upcoming-events');
    }
}