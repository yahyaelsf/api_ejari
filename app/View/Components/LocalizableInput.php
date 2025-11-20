<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LocalizableInput extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $language;
    public $input;
    public $item;

    public function __construct($language, $input, $item)
    {
        $this->language = $language;
        $this->input = $input;
        $this->item = $item;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.localizable-input');
    }
}
