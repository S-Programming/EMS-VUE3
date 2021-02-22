<?php
namespace Database\Seeders;
use Carbon\Carbon;
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
            ['id' => 1, 'first_name' => 'Super', 'last_name' => 'Admin', 'email' => 'abbasnaumani+1@gmail.com', 'phone_number' => '4545454545', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 2, 'first_name' => 'Admin', 'last_name' => 'User', 'email' => 'abbasnaumani+2@gmail.com', 'phone_number' => '4545454545', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 3, 'first_name' => 'EngagementManager', 'last_name' => 'User', 'email' => 'abbasnaumani+3@gmail.com', 'phone_number' => '4545454545', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 4, 'first_name' => 'ProjectManager', 'last_name' => 'User', 'email' => 'abbasnaumani+4@gmail.com', 'phone_number' => '4545454545', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 5, 'first_name' => 'Simple', 'last_name' => 'User', 'email' => 'abbasnaumani+5@gmail.com', 'phone_number' => '4545454545', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 6, 'first_name' => 'Muhammad', 'last_name' => 'Saddique', 'email' => 'saddiquearain99@gmail.com', 'phone_number' => '+923161880989', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],

        ];
        DB::table('users')->insert($users);
    }
}
