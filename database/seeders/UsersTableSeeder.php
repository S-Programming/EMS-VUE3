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
            ['id' => 1, 'first_name' => 'Super', 'last_name' => 'Admin', 'email' => 'abbasnaumani+1@gmail.com', 'phone_number' => '+923226983833', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 2, 'first_name' => 'Admin', 'last_name' => 'User', 'email' => 'abbasnaumani+2@gmail.com', 'phone_number' => '+923456983833', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 3, 'first_name' => 'EngagementManager', 'last_name' => 'User', 'email' => 'abbasnaumani+3@gmail.com', 'phone_number' => '+923126983833', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 4, 'first_name' => 'ProjectManager', 'last_name' => 'User', 'email' => 'abbasnaumani+4@gmail.com', 'phone_number' => '+923346983833', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ## Developers
            ['id' => 5, 'first_name' => 'Muhammad', 'last_name' => 'Saddique', 'email' => 'kodestudio1@gmail.com', 'phone_number' => '+923161880989', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 6, 'first_name' => 'Saad', 'last_name' => 'Younas', 'email' => 'saad.kodestudio@gmail.com', 'phone_number' => '+923244230228', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 7, 'first_name' => 'Mudassar', 'last_name' => 'Hussain', 'email' => 'mudassar.kodestudio@gmail.com', 'phone_number' => '+923214814456', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 8, 'first_name' => 'Hassam', 'last_name' => 'Ul Haq', 'email' => 'kodestudio.official@gmail.com', 'phone_number' => '+923324080612', 'password' => bcrypt('12345678'), 'is_active' => 1, 'is_approved' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],

        ];
        DB::table('users')->insert($users);
    }
}
