<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public function __construct(
        public mixed $headerWidget = null,
        public mixed $footerWidget = null,
        public string $page = 'homepage',
        public string $locale = 'id',
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('layouts.app');
    }
}
