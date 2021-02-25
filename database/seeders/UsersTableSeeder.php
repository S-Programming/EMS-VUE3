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

            ['id' => 10, 'first_name' => 'umair', 'last_name' => 'hanif', 'email' => 'umair@gmail.com', 'phone_number' => '+923161880989', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 11, 'first_name' => 'zubair', 'last_name' => 'hanif', 'email' => 'zubair@gmail.com', 'phone_number' => '+923161880989', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 12, 'first_name' => 'imran', 'last_name' => 'Nazim', 'email' => 'imran@gmail.com', 'phone_number' => '+923161880989', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 13, 'first_name' => 'farhan', 'last_name' => 'Jutt', 'email' => 'farhan@gmail.com', 'phone_number' => '+923161880989', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],

            ['id' => 21, 'first_name' => 'Meqdaam', 'last_name' => 'Anwar', 'email' => 'Meqdaam@gmail.com', 'phone_number' => '+923161880989', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 22, 'first_name' => 'Jamo', 'last_name' => 'Jutt', 'email' => 'Jamo@gmail.com', 'phone_number' => '+923161880989', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 23, 'first_name' => 'Chano', 'last_name' => 'Cheema', 'email' => 'Chano@gmail.com', 'phone_number' => '+923161880989', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 24, 'first_name' => 'Ali', 'last_name' => 'Bhatti', 'email' => 'Ali@gmail.com', 'phone_number' => '+923161880989', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 25, 'first_name' => 'Zafar', 'last_name' => 'Kamboh', 'email' => 'Zafar@gmail.com', 'phone_number' => '+923161880989', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],

        ];
        DB::table('users')->insert($users);
    }
}
