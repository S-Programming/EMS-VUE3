<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRoles = [
            ['user_id' => 1, 'role_id' => 1],
            ['user_id' => 2, 'role_id' => 2],
            ['user_id' => 3, 'role_id' => 3],
            ['user_id' => 4, 'role_id' => 4],
            ['user_id' => 5, 'role_id' => 5],
            ['user_id' => 6, 'role_id' => 6],

            ['user_id' => 9, 'role_id' => 9],

            ['user_id' => 10, 'role_id' => 4],
            ['user_id' => 11, 'role_id' => 4],
            ['user_id' => 12, 'role_id' => 4],
            ['user_id' => 13, 'role_id' => 4],

            ['user_id' => 21, 'role_id' => 5],
            ['user_id' => 22, 'role_id' => 5],
            ['user_id' => 23, 'role_id' => 5],
            ['user_id' => 24, 'role_id' => 5],
            ['user_id' => 25, 'role_id' => 5],
        ];
        DB::table('role_user')->insert($userRoles);
    }
}
