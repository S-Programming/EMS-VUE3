<?php

namespace App\View\Components;

use App\Http\Traits\AuthUser;
use App\Models\MenuRole;
use Illuminate\View\Component;

class Sidebar extends Component
{
    use AuthUser;

    public $menus;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

        //$this->menus = view('utils._partial.parent_menus')->render();
        $menus = $this->menuRole();
        $this->menus = $this->sidebarHtml($menus);

    }

    /**
     * User role menus
     *
     * @return mixed
     */
    public function sidebarHtml($menus = [])
    {
        $html = '';
        if (isset($menus) && count($menus) > 0) {
            foreach ($menus as $menu) {
                $subMenus = $this->menuRole(['parent_id' => ($menu['menu_id'] ?? 0)]);
                if (isset($subMenus) && !empty($subMenus)) {
                    $innerHtml = $this->sidebarHtml($subMenus);
                    if ($innerHtml != '') {
                        $html = view('utils._partial.parent_menus', ['data' => ($menu['menu'] ?? []), 'inner_html' => $innerHtml])->render();
                    }
                } else {
                    $html = view('utils._partial.menu', ['data' => ($menu['menu'] ?? [])])->render();
                }
            }
        }
        return $html;
    }


    /**
     * }
     * User role menus
     *
     * @return mixed
     */
    public function menuRole($requestData = [])
    {
        $parentId = $requestData['parent_id'] ?? 0;
        $parentMenus = MenuRole::with('menu')->whereIn('role_id', $this->userRoles())->whereHas('menu', function ($query) use ($parentId) {
            $query->where('parent_id', $parentId);
        })->get();
        return $parentMenus ? $parentMenus->toArray() : [];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.sidebar');
    }
}
