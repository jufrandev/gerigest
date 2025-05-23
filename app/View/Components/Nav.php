<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Nav extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Constructor logic can be added here if needed
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav');
    }
}
