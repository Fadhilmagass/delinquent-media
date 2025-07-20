<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Halaman daftar event
     */
    public function index(Request $request)
    {
        $query = Event::query()->with('bands');

        // Filter berdasarkan pencarian teks
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('venue', 'like', "%{$search}%")
                    ->orWhereHas('bands', function ($bandQuery) use ($search) {
                        $bandQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Filter berdasarkan waktu (mendatang/lampau)
        $filter = $request->input('filter', 'upcoming'); // Default ke 'upcoming'
        if ($filter === 'upcoming') {
            $query->where('event_time', '>=', now())->orderBy('event_time', 'asc');
        } elseif ($filter === 'past') {
            $query->where('event_time', '<', now())->orderBy('event_time', 'desc');
        } else {
            $query->orderBy('event_time', 'desc');
        }

        $events = $query->paginate(12)->withQueryString();

        return view('events.index', [
            'events' => $events,
            'filters' => ['search' => $request->input('search'), 'filter' => $filter],
        ]);
    }

    /**
     * Halaman detail event
     */
    public function show(Event $event)
    {
        $event->load(['bands.media']);

        return view('events.show', compact('event'));
    }
}
