<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarTree extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $name;
//    public $icon;
    public $paths ;

    /**
     * SidebarTree constructor.
     * @param $name
     * @param $icon
     */
    public function __construct($name,$paths)
    {
        $this->name = $name;
        $this->paths = $paths;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.sidebar-tree');
    }
}
