<?php

namespace App\Http\Controllers;

use App\Models\Band;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BandController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin'])->except(['index', 'show']);
    }
    /**
     * Menampilkan daftar band untuk publik.
     */
    public function index(Request $request): View
    {
        $query = Band::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('genre', 'like', '%' . $search . '%')
                    ->orWhere('origin', 'like', '%' . $search . '%');
            });
        }

        $bands = $query->with('media')->latest()->paginate(12)->withQueryString();

        return view('bands.index', [
            'bands' => $bands,
        ]);
    }

    /**
     * Menampilkan detail satu band.
     */
    public function show(Band $band)
    {
        $band->load('releases');
        return view('bands.show', compact('band'));
    }

    public function create()
    {
        return view('bands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'origin' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:1024',
        ]);

        $band = Band::create($request->only('name', 'origin', 'genre', 'bio'));

        if ($request->hasFile('photo')) {
            $band->addMediaFromRequest('photo')->toMediaCollection('band-photos');
        }

        return redirect()->route('bands.index');
    }

    public function edit(Band $band)
    {
        return view('bands.edit', compact('band'));
    }

    public function update(Request $request, Band $band)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'origin' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:1024',
        ]);

        $band->update($request->only('name', 'origin', 'genre', 'bio'));

        if ($request->hasFile('photo')) {
            $band->clearMediaCollection('band-photos');
            $band->addMediaFromRequest('photo')->toMediaCollection('band-photos');
        }

        return redirect()->route('bands.index');
    }

    public function destroy(Band $band)
    {
        $band->delete();

        return redirect()->route('bands.index');
    }
}
