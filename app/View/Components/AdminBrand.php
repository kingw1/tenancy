<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminBrand extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return <<<'HTML'
                <a href="/">
                    <!-- Hidden when collapsed -->
                    <div {{ $attributes->class(["hidden-when-collapsed"]) }}>
                        <div class="flex items-center gap-2 w-fit">
                            <x-icon name="o-cube" class="w-6 -mb-1.5 text-purple-500" />
                            <span class="font-bold text-2xl me-3 bg-gradient-to-r from-purple-500 to-pink-300 bg-clip-text text-transparent ">
                                Admin Panel
                            </span>
                        </div>
                    </div>

                    <!-- Display when collapsed -->
                    <div class="display-when-collapsed hidden mb-1 h-[28px]">
                        <x-icon name="s-cube" class="w-6 -mb-1.5 text-purple-500" />
                    </div>
                </a>
            HTML;
    }
}
