<?php

namespace App\View\Components;

use App\Http\Traits\AuthUser;
use Illuminate\View\Component;

class BackendLayout extends Component
{
    use AuthUser;
    public $user;

    /**
     * Create the component instance.
     *
     * @param string $type
     * @param string $message
     * @return void
     */
    public function __construct()
    {
        $this->user = $this->getAuthUser();
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
