<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $menuRoles = [
            ['is_allow' => 1, 'role_id' => 1, 'menu_id' => 1], // Super Admin
            ['is_allow' => 1, 'role_id' => 1, 'menu_id' => 2],
            ['is_allow' => 1, 'role_id' => 1, 'menu_id' => 3],
            ['is_allow' => 1, 'role_id' => 1, 'menu_id' => 4],
            ['is_allow' => 1, 'role_id' => 1, 'menu_id' => 5],
            ['is_allow' => 1, 'role_id' => 1, 'menu_id' => 6],
            ['is_allow' => 1, 'role_id' => 1, 'menu_id' => 7],
            ['is_allow' => 1, 'role_id' => 1, 'menu_id' => 9],
            ['is_allow' => 1, 'role_id' => 1, 'menu_id' => 10],
            ['is_allow' => 1, 'role_id' => 2, 'menu_id' => 1], // Admin
            ['is_allow' => 1, 'role_id' => 2, 'menu_id' => 2],
            ['is_allow' => 1, 'role_id' => 2, 'menu_id' => 3],
            ['is_allow' => 1, 'role_id' => 2, 'menu_id' => 4],
            ['is_allow' => 1, 'role_id' => 2, 'menu_id' => 5],
            ['is_allow' => 1, 'role_id' => 2, 'menu_id' => 6],
            ['is_allow' => 1, 'role_id' => 2, 'menu_id' => 7],
            ['is_allow' => 1, 'role_id' => 2, 'menu_id' => 9],
            ['is_allow' => 1, 'role_id' => 2, 'menu_id' => 10],
            ['is_allow' => 1, 'role_id' => 2, 'menu_id' => 12],
            ['is_allow' => 1, 'role_id' => 3, 'menu_id' => 1], // Developer
            ['is_allow' => 1, 'role_id' => 3, 'menu_id' => 3],
            ['is_allow' => 1, 'role_id' => 3, 'menu_id' => 5],
            ['is_allow' => 1, 'role_id' => 3, 'menu_id' => 8],
            ['is_allow' => 1, 'role_id' => 3, 'menu_id' => 11],


        ];
        DB::table('menu_role')->insert($menuRoles);
    }
}
