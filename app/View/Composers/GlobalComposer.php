<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;
use App\Models\Tag;

class GlobalComposer
{
    public function compose(View $view): void
    {
        $categories = Cache::remember('all_categories', 60 * 60, fn() => Category::orderBy('name')->get());
        $tags = Cache::remember('all_tags', 60 * 60, fn() => Tag::orderBy('name')->get());

        $view->with([
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }
}
