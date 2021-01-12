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
            ['id' => 1, 'name' => 'Dashboard', 'is_parent_menu' => 0, 'parent_menu_id' => 1, 'link' => 'link 1', 'module' => 'Module 1', 'sort_order' => 'Sort Order 1', 'class' => 'Class 1' , 'icon' => 'icon 1', 'is_count' => 0 , 'is_active' => 1],
            ['id' => 2, 'name' => 'User Profile', 'is_parent_menu' => 1, 'parent_menu_id' => 2, 'link' => 'link 2', 'module' => 'Module 2', 'sort_order' => 'Sort Order 2', 'class' => 'Class 2' , 'icon' => 'icon 2', 'is_count' => 1 , 'is_active' => 1],
            ['id' => 3, 'name' => 'Checkin History', 'is_parent_menu' => 0, 'parent_menu_id' => 1, 'link' => 'link 3', 'module' => 'Module 3', 'sort_order' => 'Sort Order 3', 'class' => 'Class 3' , 'icon' => 'icon 3', 'is_count' => 0 , 'is_active' => 1],
            ['id' => 4, 'name' => 'Role', 'is_parent_menu' => 1, 'parent_menu_id' => 2, 'link' => 'link 4', 'module' => 'Module 4', 'sort_order' => 'Sort Order 4', 'class' => 'Class 4' , 'icon' => 'icon 4', 'is_count' => 1 , 'is_active' => 1],

        ];
        DB::table('menus')->insert($menus);

    }
}
