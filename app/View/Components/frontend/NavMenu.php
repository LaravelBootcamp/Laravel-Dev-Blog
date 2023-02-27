<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;

class NavMenu extends Component
{
    public $menus;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($menus)
    {
        $this->menus = $menus;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.nav-menu');
    }
}
