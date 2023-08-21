<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class Admin extends Component
{

    public function __construct(
        public ?string $title = null,
        public ?string $script = null,
    )
    {
        //
    }

    public final function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|string|\Closure|\Illuminate\Contracts\Foundation\Application
    {
        return view('layouts.admin.master');
    }
}
