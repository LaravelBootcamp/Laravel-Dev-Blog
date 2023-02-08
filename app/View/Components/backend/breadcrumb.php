<?php

namespace App\View\Components\backend;

use Illuminate\View\Component;

class breadcrumb extends Component
{
    public $list = null;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($list = null)
    {
        $this->list = $list;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.breadcrumb');
    }
}
