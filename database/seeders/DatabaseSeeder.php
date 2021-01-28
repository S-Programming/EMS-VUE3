<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(ActivityStatementTableSeeder::class);
        $this->call(GlobalSettingsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(MenuRoleTableSeeder::class);
        $this->call(LeaveTypeSeeder::class);
        $this->call(RequestStatusSeeder::class);
        $this->call(HolidaySeeder::class);
        $this->call(AttendanceSeeder::class);
    }
}
