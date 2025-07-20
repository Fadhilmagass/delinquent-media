<?php

namespace App\Livewire\Band;

use App\Models\Band;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Lazy;

#[Lazy]
class ReleaseList extends Component
{
    use WithPagination;
    public Band $band;

    public function placeholder()
    {
        return <<<'HTML'
            <div class="space-y-4">
                <div class="flex items-center bg-white dark:bg-gray-800 p-4 rounded-lg shadow animate-pulse">
                    <div class="w-20 h-20 rounded-md mr-4 bg-gray-200"></div>
                    <div class="flex-1 space-y-2">
                        <div class="h-6 bg-gray-200 rounded w-3/4"></div>
                        <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                    </div>
                </div>
                <div class="flex items-center bg-white dark:bg-gray-800 p-4 rounded-lg shadow animate-pulse">
                    <div class="w-20 h-20 rounded-md mr-4 bg-gray-200"></div>
                    <div class="flex-1 space-y-2">
                        <div class="h-6 bg-gray-200 rounded w-3/4"></div>
                        <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                    </div>
                </div>
            </div>
        HTML;
    }

    public function render()
    {
        $releases = $this->band->releases()
            ->latest('release_date')
            ->paginate(5);

        return view('livewire.band.release-list', compact('releases'));
    }
}
