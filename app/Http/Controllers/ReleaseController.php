<?php

namespace App\Http\Controllers;

use App\Models\Release;
use Illuminate\Http\Request;

class ReleaseController extends Controller
{
    public function show(Release $release)
    {
        $release->load(['band.media', 'tracks', 'media']);
        return view('releases.show', compact('release'));
    }
}
