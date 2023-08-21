<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public ?string $header = null,
        public ?string $footer = null,
    )
    {
    }

    public function render()
    {
        return view('components.card');
    }
}
