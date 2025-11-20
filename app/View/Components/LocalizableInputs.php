<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LocalizableInputs extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $inputs;
    public $item;

    public function __construct($inputs, $item)
    {
        $this->inputs = $inputs;
        $this->item = $item;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.localizable-inputs');
    }
}
