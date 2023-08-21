<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class Landing extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public ?string $title = null,
        public ?string $script = null,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.landing.master');
    }
}
