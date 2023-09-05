<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CounterCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public int $count, public string $title, public string $image = "", public string $icon = "", public string $target = "")
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
        return view('components.counter-card');
    }
}
