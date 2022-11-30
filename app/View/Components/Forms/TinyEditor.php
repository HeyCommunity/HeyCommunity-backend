<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class TinyEditor extends Component
{
    public $inputName;
    public $inputValue;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($inputName, $inputValue)
    {
        $this->inputName = $inputName;
        $this->inputValue = $inputValue;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.tiny-editor');
    }
}
