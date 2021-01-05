<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BackendLayout extends Component
{
    public $name;
    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    public function __construct($name='')
    {
        $this->name = $name;
    }
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.backend');
    }
}
