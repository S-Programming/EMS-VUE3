<?php

namespace App\View\Components;

use App\Http\Traits\AuthUser;
use Illuminate\View\Component;

class BackendLayout extends Component
{
    use AuthUser;

    public $user;
    public $is_user_checkin;
    public $user_last_checkin;
    public $menu_data;

    /**
     * Create the component instance.
     *
     * @param string $type
     * @param string $message
     * @return void
     */
    public function __construct($menu_data=[])
    {
        $this->user = $this->getAuthUser();
        $this->is_user_checkin = $this->isUserCheckin();
        $this->user_last_checkin = $this->is_user_checkin ? $this->user->lastCheckin()->checkin : '';
        $this->menu_data = $menu_data;
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
