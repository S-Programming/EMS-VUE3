<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $LeaveType = [
            ['type' => 'Casual'], 
            ['type' => 'Sick'], 
            ['type' => 'Urgent Work']
            
        ];
        DB::table('leave_type')->insert($LeaveType);
    }
}
