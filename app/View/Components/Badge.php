<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Badge extends Component
{
    public string $bgColor;
    public string $textColor;

    public function __construct(public string $color = 'gray')
    {
        $this->bgColor = match ($color) {
            'green' => 'bg-green-100',
            'orange' => 'bg-orange-100',
            'blue' => 'bg-blue-100',
            'red' => 'bg-red-100',
            default => 'bg-gray-100',
        };

        $this->textColor = match ($color) {
            'green' => 'text-green-800',
            'orange' => 'text-orange-800',
            'blue' => 'text-blue-800',
            'red' => 'text-red-800',
            default => 'text-gray-800',
        };
    }

    public function render(): View|Closure|string
    {
        return view('components.badge');
    }
}
