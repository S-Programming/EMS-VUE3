<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            ['id' => 1, 'name' => 'Dashboard', 'parent_id' => 0, 'route' => 'dashboard', 'sort_order' => 0, 'class' => 'nav-main-link-name', 'icon' => 'si si-cursor', 'is_count' => 0, 'is_active' => 1],
            ['id' => 2, 'name' => 'Users', 'parent_id' => 5, 'route' => 'user.list', 'sort_order' => 0, 'class' => 'nav-main-link-name', 'icon' => 'fa fa-users', 'is_count' => 0, 'is_active' => 1],
            ['id' => 3, 'name' => 'User Profile', 'parent_id' => 5, 'route' => 'user.edit.profile', 'sort_order' => 0, 'class' => 'nav-main-link-submenu', 'icon' => 'fa fa-users', 'is_count' => 0, 'is_active' => 1],
            ['id' => 4, 'name' => 'Role', 'parent_id' => 0, 'route' => 'role.list', 'sort_order' => 0, 'class' => 'nav-main-link-name', 'icon' => 'fa fa-user', 'is_count' => 0, 'is_active' => 1],
            ['id' => 5, 'name' => 'User Section', 'parent_id' => 0, 'route' => 'user.*', 'sort_order' => 0, 'class' => 'nav-main-link-name', 'icon' => 'fa fa-user', 'is_count' => 0, 'is_active' => 1],
            ['id' => 6, 'name' => 'Checkin History', 'parent_id' => 0, 'route' => 'checkin.users.report', 'sort_order' => 0, 'class' => 'nav-main-link-name', 'icon' => 'fa fa-user', 'is_count' => 0, 'is_active' => 1],
           
            ['id' => 7, 'name' => 'Leave Approval', 'parent_id' => 0, 'route' => 'leave.approve.list', 'sort_order' => 0, 'class' => 'nav-main-link-name', 'icon' => 'fa fa-user', 'is_count' => 0, 'is_active' => 1],
            ['id' => 8, 'name' => 'Apply Leave', 'parent_id' => 0, 'route' => 'leave.list', 'sort_order' => 0, 'class' => 'nav-main-link-name', 'icon' => 'fa fa-user', 'is_count' => 0, 'is_active' => 1],
            ['id' => 9, 'name' => 'Leave Type', 'parent_id' => 0, 'route' => 'leave.type.list', 'sort_order' => 0, 'class' => 'nav-main-link-name', 'icon' => 'fa fa-user', 'is_count' => 0, 'is_active' => 1],
            ['id' => 10, 'name' => 'Leave Status', 'parent_id' => 0, 'route' => 'leave.status.list', 'sort_order' => 0, 'class' => 'nav-main-link-name', 'icon' => 'fa fa-user', 'is_count' => 0, 'is_active' => 1],
            ['id' => 11, 'name' => 'Attendence', 'parent_id' => 0, 'route' => 'attendence.mark', 'sort_order' => 0, 'class' => 'nav-main-link-name', 'icon' => 'fa fa-user', 'is_count' => 0, 'is_active' => 1],
            
        ];
        DB::table('menus')->insert($menus);
    }
}
