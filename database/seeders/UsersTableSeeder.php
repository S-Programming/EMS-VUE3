<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['id' => 1, 'first_name' => 'Super', 'last_name' => 'Admin', 'email' => 'abbasnaumani+1@gmail.com', 'phone_number' => '4545454545', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1],
            ['id' => 2, 'first_name' => 'Admin', 'last_name' => 'User', 'email' => 'abbasnaumani+2@gmail.com', 'phone_number' => '4545454545', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1],
            ['id' => 3, 'first_name' => 'Simple', 'last_name' => 'User', 'email' => 'abbasnaumani+3@gmail.com', 'phone_number' => '4545454545', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1],

        ];
        DB::table('users')->insert($users);
    }
}
