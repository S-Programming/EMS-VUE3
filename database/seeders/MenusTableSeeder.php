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
            ['id' => 1, 'name' => 'Dashboard', 'is_parent_menu' => 0, 'parent_menu_id' => 0, 'link' => '/dashboard', 'sort_order' => 0, 'class' => 'nav-main-link-name' , 'icon' => 'si si-cursor', 'is_count' => 0, 'is_active' => 1],
            ['id' => 2, 'name' => 'Users', 'is_parent_menu' => 1, 'parent_menu_id' => 0, 'link' => '/user', 'sort_order' => 0, 'class' => 'nav-main-link-name' , 'icon' => 'fa fa-users', 'is_count' => 0, 'is_active' => 1],
            ['id' => 3, 'name' => 'User Profile', 'is_parent_menu' => 0, 'parent_menu_id' => 2, 'link' => '/self_edit_profile', 'sort_order' => 0, 'class' => 'nav-main-link-submenu' , 'icon' => 'fa fa-users', 'is_count' => 0, 'is_active' => 1],
            ['id' => 4, 'name' => 'Role', 'is_parent_menu' => 0, 'parent_menu_id' => 0, 'link' => '/role', 'sort_order' => 0, 'class' => 'nav-main-link-name' , 'icon' => 'fa fa-user', 'is_count' => 0, 'is_active' => 1],
        ];
        DB::table('menus')->insert($menus);
    }
}
