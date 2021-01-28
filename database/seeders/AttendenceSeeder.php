<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attendance = [
            ['id' => 1, 'user_id' => 1, 'is_present' => 1, 'entry_ip' => '', 'entry_location' => '', 'exit_ip' => '', 'exit_location' => '', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 2, 'user_id' => 2, 'is_present' => 1, 'entry_ip' => '', 'entry_location' => '', 'exit_ip' => '', 'exit_location' => '', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 3, 'user_id' => 3, 'is_present' => 0, 'entry_ip' => '', 'entry_location' => '', 'exit_ip' => '', 'exit_location' => '', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            // ['id' => 4, 'user_id' => 4, 'is_present' => 1, 'entry_ip' => '', 'entry_location' => '', 'exit_ip' => '', 'exit_location' => '', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            // ['id' => 5, 'user_id' => 5, 'is_present' => 0, 'entry_ip' => '', 'entry_location' => '', 'exit_ip' => '', 'exit_location' => '', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],

        ];
        DB::table('attendences')->insert($attendance);
    }
}
