<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         $LeaveStatus = [
            ['status' => 'Pending'], 
            ['status' => 'Approve'], 
            ['status' => 'Reject'], 
            
            
        ];
        DB::table('leave_status')->insert($LeaveStatus);
    }
}
